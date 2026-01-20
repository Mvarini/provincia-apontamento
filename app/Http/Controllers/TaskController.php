<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Employee;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//            $tasks = Task::orderBy('date', 'desc')->paginate(10);

        $tasks = Task::when($request->has('batch_number'), function ($query) use ($request) {
            $query->where('batch_number', 'like', '%' . $request->batch_number . '%');
        })
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', '=', carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'));
            })
            ->orderBy('date', 'desc')->paginate(10)
            ->withQueryString();

        return view('tasks.index', [
            'sidebar' => 'apontamentos',
            'tasks' => $tasks,
            'batch_number' => $request->batch_number,
            'date' => $request->date
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machines = Machine::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $products = Product::orderBy('name', 'asc')->get();

        return view('tasks.create', [
            'sidebar' => 'apontamentos',
            'machines' => $machines,
            'employees' => $employees,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();


        DB::beginTransaction();

        try {

            if ($validated['production_minute'] > 0 && $validated['piece_second'] > 0) {
                $expectedQuantity = $validated['production_minute'] * 60 / $validated['piece_second'];
            } else {
                $expectedQuantity = null;
            }


            if ($validated['amount_carried'] > 0) {
                $productivity = $validated['amount_carried'] * 100 / $expectedQuantity;
            } else {
                $productivity = null;
            }

            $scriptTime = str_replace(',', '.', $validated['script_time']);


            // Campo de data
            $data = Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

            // Adiciona os campos calculados ao array de dados
            $validated['expected_quantity'] = $expectedQuantity;
            $validated['productivity'] = $productivity;
            $validated['date'] = $data;
            $validated['script_time'] = $scriptTime == '' ? null : $scriptTime;


            $task = Task::create($validated);

            Log::info('Apontamento cadastrado', ['id' => $task->id, 'action_id_user' => Auth::id()]);

            DB::commit();

            return redirect()->route('task.index')->with('success', 'Apontamento cadastrado com sucesso!');

        } catch (\Exception $e) {
            Log::error('Apontamento não cadastrado', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString(), 'action_id_user' => Auth::id()]);
            DB::rollBack();
            return back()->withInput()->with('error', 'Apontamento não cadastrado');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $machines = Machine::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();
        $products = Product::orderBy('name', 'asc')->get();

        return view('tasks.edit', [
            'sidebar' => 'apontamentos',
            'task' => $task,
            'machines' => $machines,
            'employees' => $employees,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            if ($validated['production_minute'] > 0 && $validated['piece_second'] > 0) {
                $expectedQuantity = $validated['production_minute'] * 60 / $validated['piece_second'];
            } else {
                $expectedQuantity = null;
            }


            if ($validated['amount_carried'] > 0) {
                $productivity = $validated['amount_carried'] * 100 / $expectedQuantity;
            } else {
                $productivity = null;
            }
//            // Calcula os campos
//            $expectedQuantity = $validated['production_minute'] * 60 / $validated['piece_second'];
//            $productivity = $validated['amount_carried'] * 100 / $expectedQuantity;

            $scriptTime = str_replace(',', '.', $validated['script_time']);

            // Campo de data
            $data = Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

            // Adiciona os campos calculados ao array de dados
            $validated['expected_quantity'] = $expectedQuantity;
            $validated['productivity'] = $productivity;
            $validated['date'] = $data;
            $validated['script_time'] = $scriptTime == '' ? null : $scriptTime;

            $task->update($validated);

            Log::info('Apontamento editado', ['id' => $task->id, 'action_id_user' => Auth::id()]);

            DB::commit();

            return redirect()->route('task.index')->with('success', 'Apontamento editado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Apontamento não editado', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

            DB::rollBack();

            return back()->withInput()->with('error', 'Apontamento não pode ser atualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('task.index')->with('success', 'Apontamento deletado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao deletar apontamento');
        }
    }


    public function reportTask(Request $request)
    {
        // Aumenta o tempo de execução para 5 minutos (300 segundos)
        set_time_limit(300);

        // Aumenta o limite de memória também, pois relatórios grandes exigem isso
        ini_set('memory_limit', '512M');

        //VERIFICAÇÃO COM filled() E REDIRECIONAMENTO MANUAL
        if (!$request->filled('date') && !$request->filled('batch_number')) {
            // Se a data não estiver preenchida, armazena a mensagem de erro na sessão
            // e redireciona de volta para o formulário.
            return redirect()->route('task.index')->with('error', 'Informe o lote ou a  data para gerar o relatório');
        }

//        $tasks = Task::when($request->has('batch_number'), function ($query) use ($request) {
//            $query->where('batch_number', 'like', '%' . $request->batch_number . '%');
//        })
//            ->when($request->filled('date'), function ($query) use ($request) {
//                $query->where('date', '=', carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'));
//            })
//            ->orderBy('date', 'desc')
//            ->get();

        $tasks = Task::select('tasks.*') // 1. Seleciona explicitamente as colunas de 'tasks'
        ->join('machines', 'tasks.machine_id', '=', 'machines.id') // 2. Junta a tabela 'machines'
        ->when($request->has('batch_number'), function ($query) use ($request) {
            $query->where('batch_number', 'like', '%' . $request->batch_number . '%');
        })
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', '=', Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'));
            })
            // 3. Adiciona a ordenação primária pelo nome da máquina
            ->orderBy('machines.name', 'asc')
            // 4. Mantém a ordenação secundária pela data da tarefa (desc)
            ->orderBy('date', 'desc')
            ->get();

        $tasks->load('machine', 'employee', 'product', 'taskBreakdowns');


        $html = view('tasks.reports.report', [
            'tasks' => $tasks,
            'sidebar' => 'apontamentos',
        ])->render();


//            $pdf = Browsershot::html($html)
//                ->format('A4')
//                ->setChromePath('/Applications/Google Chrome.app/Contents/MacOS/Google Chrome')
//                ->margins(1, 1, 1, 1)
//                ->waitUntilNetworkIdle()
//                ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox'])
//                ->showBrowserHeaderAndFooter()
//                ->footerHtml(view('tasks.reports.footer')->render())
//                ->pdf();

        $pdf = Browsershot::html($html)
            ->format('A4')
//            ->setIncludePath('$PATH:/usr/local/bin')
            ->setChromePath('/usr/bin/google-chrome')
            ->margins(1, 1, 1, 1)
            ->waitUntilNetworkIdle()
            ->setOption('args', [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-gpu',
                '--user-data-dir=/tmp/browsershot-data',
            ])
            ->showBrowserHeaderAndFooter()
            ->footerHtml(view('tasks.reports.footer')->render())
            ->pdf();

        if ($request->date) {
            return response($pdf)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="apontamento_' . $request->date . '.pdf"')
                // Criamos um cookie simples (acessível via JS) que expira em 1 minuto
                ->withCookie(cookie('download_finished', 'true', 1, '/', null, false, false));
//            inline: visualiza o pdf
//            attachment: fazer o download direto
        } else {
            return response($pdf)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="apontamento' . '.pdf"')
                // Criamos um cookie simples (acessível via JS) que expira em 1 minuto
                ->withCookie(cookie('download_finished', 'true', 1, '/', null, false, false));
//            inline: visualiza o pdf
//            attachment: fazer o download direto
        }
    }
}

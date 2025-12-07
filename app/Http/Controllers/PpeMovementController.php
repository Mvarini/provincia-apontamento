<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PpeMovementRequest;
    use App\Models\Employee;
    use App\Models\Ppe;
    use App\Models\PpeMovement;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Spatie\Browsershot\Browsershot;

    class PpeMovementController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(Request $request)
        {
//            $ppeMovements = PpeMovement::orderBy('date', 'desc')->paginate(10);

            $ppeMovements = PpeMovement::when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', '=', Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'));
            })
                ->orderBy('date', 'desc')->paginate(10)
                ->withQueryString();

            return view('ppemovements.index', [
                'sidebar' => 'ppeMovements',
                'ppeMovements' => $ppeMovements,
                'menuOpen' => 'menuOpenEpi',
                'date' => $request->date
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $employees = Employee::orderBy('name', 'asc')->get();
            $ppes = Ppe::orderBy('name', 'asc')->get();

            return view('ppemovements.create', [
                'sidebar' => 'ppeMovements',
                'menuOpen' => 'menuOpenEpi',
                'employees' => $employees,
                'ppes' => $ppes,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(PpeMovementRequest $request)
        {
            $input = $request->validated();

            $dateFormat = Carbon::createFromFormat('d/m/Y', $input['date'])->format('Y-m-d');
            $sizeUppers = strtoupper($input['size']);

            $input['date'] = $dateFormat;
            $input['size'] = $sizeUppers;


            try {
                DB::beginTransaction();

                $ppeMovements = PpeMovement::create($input);

                Log::info('Movimentação de EPI cadastrado', ['id' => $ppeMovements->id, 'action_id_user' => auth()->id()]);

                DB::commit();

                return redirect()->route('ppe-movements.index')->with('success', 'Movimentação de EPI cadastrado com sucesso!');
            } catch (\Exception $e) {
                Log::error('Movimentação de EPI não cadastrado', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);;

                DB::rollBack();

                return back()->withInput()->with('error', 'Movimentação de EPI não cadastrado');
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(PpeMovement $ppeMovement)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(PpeMovement $ppeMovement)
        {
            $employees = Employee::orderBy('name', 'asc')->get();
            $ppes = Ppe::orderBy('name', 'asc')->get();

            return view('ppemovements.edit', [
                'sidebar' => 'ppeMovements',
                'menuOpen' => 'menuOpenEpi',
                'ppeMovement' => $ppeMovement,
                'employees' => $employees,
                'ppes' => $ppes,
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(PpeMovementRequest $request, PpeMovement $ppeMovement)
        {
            $input = $request->validated();

            try {
                DB::beginTransaction();

                $dateFormat = Carbon::createFromFormat('d/m/Y', $input['date'])->format('Y-m-d');
                $sizeUppers = strtoupper($input['size']);

                $input['date'] = $dateFormat;
                $input['size'] = $sizeUppers;

                if ($input['size'] == '') {
                    $input['size'] = null;
                }

                $ppeMovement->update($input);

                Log::info('Movimentação de EPI editada', ['id' => $ppeMovement->id, 'action_id_user' => auth()->id()]);
                DB::commit();

                return redirect()->route('ppe-movements.index')->with('success', 'Movimentação de EPI editada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Movimentação de EPI não editada', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                DB::rollBack();

                return back()->withInput()->with('error', 'Movimentação de EPI não editada');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(PpeMovement $ppeMovement)
        {
            try {
                $ppeMovement->delete();
                Log::info('Movimentação de EPI deletada', ['id' => $ppeMovement->id, 'action_id_user' => auth()->id()]);

                return redirect()->route('ppe-movements.index')->with('success', 'Movimentação de EPI deletada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Movimentação de EPI não deletada', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);

                return back()->with('error', 'Movimentação de EPI não deletada!');
            }
        }

        public function reportPpe(Request $request)
        {

            $ppeMovements = PpeMovement::when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', '=', Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'));
            })
                ->orderBy('date', 'desc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $ppeMovements->load('employee', 'ppe');

            // Totais por EPI
            $totais = $ppeMovements->groupBy(function ($item) {
                return $item->ppe->name . ' - ' . ($item->size ?? 'N/A');
            })->map(function ($group) {
                return $group->sum('quantity');
            });

            $html = view('ppemovements.reports.report', [
                  'sidebar' => 'ppeMovements',
                  'ppeMovements' => $ppeMovements,
                  'menuOpen' => 'menuOpenEpi',
                  'totais' => $totais,
              ]);

              // Desabilita header - usado local
//              $pdf = Browsershot::html($html)
//                  ->format('A4')
//                  //->setChromePath('/Applications/Google Chrome.app/Contents/MacOS/Google Chrome')
//                  ->margins(1, 1, 1, 1)
//                  ->waitUntilNetworkIdle()
//                  ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox'])
//                  ->setOption('displayHeaderFooter', true) // habilita header/footer
//                  ->setOption('headerTemplate', '<span></span>') // header vazio
//                  ->setOption('footerTemplate', view('ppemovements.reports.footer')->render())
//                  ->pdf();

            // Desabilita header - Usado no servidor
            $pdf = Browsershot::html($html)
                ->format('A4')
               ->setChromePath('/usr/bin/chromium')
                ->setIncludePath('$PATH:/usr/local/bin')
                ->margins(1, 1, 1, 1)
                ->waitUntilNetworkIdle()
                ->setOption('args', [
                    '--no-sandbox',
                    '--disable-setuid-sandbox',
                    '--disable-dev-shm-usage',
                    '--disable-gpu',
                    '--user-data-dir=/tmp/chromium-data', // <<< ADICIONE AQUI
                ])
                ->setOption('displayHeaderFooter', true) // habilita header/footer
                ->setOption('headerTemplate', '<span></span>') // header vazio
                ->setOption('footerTemplate', view('ppemovements.reports.footer')->render())
                ->pdf();



            if ($request->date) {
                return response($pdf)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="movimentação_epi_' . $request->date . '.pdf"');
//            inline: visualiza o pdf
//            attachment: fazer o download direto
            }else{
                return response($pdf)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="movimentação_epi'. '.pdf"');
//            inline: visualiza o pdf
//            attachment: fazer o download direto
            }

        }
    }

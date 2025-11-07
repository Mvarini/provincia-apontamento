<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\MachineRequest;
    use App\Models\Machine;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class MachineController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $machines = Machine::orderBy('name', 'asc')->paginate(10);

            return view('machines.index', [
                'machines' => $machines,
                'sidebar' => 'máquinas'
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('machines.create', [
                'sidebar' => 'máquinas'
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(MachineRequest $request)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $machine = Machine::create($request->all());

                Log::info('Máquina cadastrado', ['id' => $machine->id, 'action_id_user' => Auth::id()]);

                DB::commit();

                return redirect()->route('machine.index')->with('success', 'Máquina cadastrada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Máquina não cadastrada', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Máquina não cadastrada!');
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(Machine $machine)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Machine $machine)
        {
            return view('machines.edit', [
                'machine' => $machine,
                'sidebar' => 'máquinas'
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(MachineRequest $request, Machine $machine)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $machine->update($request->all());

                Log::info('Máquina atualizado', ['id' => $machine->id, 'action_id_user' => Auth::id()]);

                db::commit();

                return redirect()->route('machine.index')->with('success', 'Máquina atualizada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Máquina não atualizada', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Máquina não atualizada!');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Machine $machine)
        {
            try {
                $machine->delete();

                Log::info('Máquina excluída', ['id' => $machine->id, 'action_id_user' => Auth::id()]);

                return redirect()->route('machine.index')->with('success', 'Máquina excluída com sucesso!');

            } catch (\Exception $e) {
                Log::error('Máquina não excluída', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                return back()->with('error', 'Máquina não excluída');
            }
        }
    }

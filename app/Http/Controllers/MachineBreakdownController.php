<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\MachineBreakdownRequest;
    use App\Models\MachineBreakdown;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class MachineBreakdownController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $machineBreakdowns = MachineBreakdown::orderBy('name', 'asc')->paginate(10);

            return view('machinebreakdowns.index', [
                'machineBreakdowns' => $machineBreakdowns,
                'sidebar' => 'paradas',
                'menuOpen' => 'menuOpen'
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('machinebreakdowns.create', [
                'sidebar' => 'paradas',
                'menuOpen' => 'menuOpen'
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(MachineBreakdownRequest $request)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $machineBreakdown = MachineBreakdown::create([
                    'name' => $request->name,
                ]);

                Log::info('Parada de máquina cadastrada', ['id' => $machineBreakdown->id, 'action_id_user' => Auth::id()]);

                DB::commit();

                return redirect()->route('machinebreakdown.index')->with('success', 'Parada de máquina cadastrada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Parada de máquina não cadastrada', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Parada de máquina não cadastrada');
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(MachineBreakdown $machineBreakdown)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(MachineBreakdown $machineBreakdown)
        {
            return view('machinebreakdowns.edit', [
                'machineBreakdown' => $machineBreakdown,
                'sidebar' => 'paradas',
                'menuOpen' => 'menuOpen'
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(MachineBreakdownRequest $request, MachineBreakdown $machineBreakdown)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $machineBreakdown->update([
                    'name' => $request->name,
                ]);

                Log::info('Parada de máquina editada', ['id' => $machineBreakdown->id, 'action_id_user' => Auth::id()]);

                DB::commit();

                return redirect()->route('machinebreakdown.index')->with('success', 'Parada de máquina editada com sucesso');
            } catch (\Exception $e) {
                Log::error('Parada de máquina não editada', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('success', 'Parada de máquina editada com sucesso');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(MachineBreakdown $machineBreakdown)
        {
            try {
                $machineBreakdown->delete();

                Log::info('Parada de máquina excluída', ['id' => $machineBreakdown->id, 'action_id_user' => Auth::id()]);

                return redirect()->route('machinebreakdown.index')->with('success', 'Parada de máquina excluída com sucesso');
            } catch (\Exception $e) {
                Log::error('Parada de máquina não excluída', ['error' => $e->getMessage(), 'action_id_user' => Auth::id()]);

                return redirect()->route('machinebreakdown.index')->with('error', 'Parada de máquina não excluída');
            }
        }
    }

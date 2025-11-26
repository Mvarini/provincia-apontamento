<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\TaskBreakdownRequest;
    use App\Models\MachineBreakdown;
    use App\Models\Task;
    use App\Models\TaskBreakdown;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class TaskBreakdownController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(Task $task)
        {

            // Paginação
            $taskBreakdowns = $task->taskBreakdowns()->orderBy('created_at', 'desc')->paginate(10);

            return view('taskbreakdowns.index', [
                'sidebar' => 'apontamentos',
                'task' => $task,
                'taskBreakdowns' => $taskBreakdowns,
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create(Task $task)
        {
            $machineBreakdowns = MachineBreakdown::orderBy('name', 'asc')->get();

            return view('taskbreakdowns.create', [
                'sidebar' => 'apontamentos',
                'machineBreakdowns' => $machineBreakdowns,
                'task' => $task,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(TaskBreakdownRequest $request)
        {
            $request->validated();

            DB::beginTransaction();

            try {

                $taskBreakdown = TaskBreakdown::create([
                    'task_id' => $request->task_id,
                    'machine_breakdown_id' => $request->machine_breakdown_id,
                    'duration' => $request->duration,
                ]);

                Log::info('Parada do apontamento cadastrada', ['id' => $taskBreakdown->id, 'action_id_user' => auth()->id()]);
                DB::commit();
                return redirect()->route('task-breakdown.index', $taskBreakdown->task_id)->with('success', 'Parada do apontamento cadastrada com sucesso!');

            } catch (\Exception $e) {
                Log::error('Parada do apontamento não cadastrada', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                DB::rollBack();
                return back()->withInput()->with('error', 'Parada do apontamento não cadastrada');
            }
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(TaskBreakdown $taskBreakdown)
        {
            $machineBreakdowns = MachineBreakdown::orderBy('name', 'asc')->get();

            return view('taskbreakdowns.edit', [
                'sidebar' => 'apontamentos',
                'taskBreakdown' => $taskBreakdown,
                'machineBreakdowns' => $machineBreakdowns,
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(TaskBreakdownRequest $request, TaskBreakdown $taskBreakdown)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $taskBreakdown->update([
                    'task_id' => $request->task_id,
                    'machine_breakdown_id' => $request->machine_breakdown_id,
                    'duration' => $request->duration,
                ]);

                Log::info('Parada do apontamento edita', ['id' => $request->id, 'action_id_user' => auth()->id()]);

                DB::commit();

                return redirect()->route('task-breakdown.index', $request->task_id)->with('success', 'Parada do apontamento editada com sucesso!');

            } catch (\Exception $e) {
                Log::error('Parada do apontamento não editada', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                DB::rollBack();

                return back()->withInput()->with('error', 'Parada do apontamento não editada!');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(TaskBreakdown $taskBreakdown)
        {
            try {
                $taskBreakdown->delete();

                Log::info('Parada do apontamento deletada', ['id' => $taskBreakdown->id, 'action_id_user' => auth()->id()]);

                return redirect()->route('task-breakdown.index', $taskBreakdown->task_id)->with('success', 'Parada do apontamento deletada com sucesso!');
            } catch (\Exception $e) {
                Log::error('Parada do apontamento não deletada', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                return back()->with('error', 'Parada do apontamento não deletada');
            }
        }
    }

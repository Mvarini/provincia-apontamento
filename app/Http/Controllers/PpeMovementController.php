<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PpeMovementRequest;
    use App\Models\Employee;
    use App\Models\Ppe;
    use App\Models\PpeMovement;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class PpeMovementController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $ppeMovements = PpeMovement::orderBy('date', 'desc')->paginate(10);

            return view('ppemovements.index', [
                'sidebar' => 'ppeMovements',
                'ppeMovements' => $ppeMovements,
                'menuOpen' => 'menuOpenEpi'
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
    }

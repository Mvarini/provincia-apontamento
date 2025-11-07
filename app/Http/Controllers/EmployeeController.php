<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\EmployeeRequest;
    use App\Models\Employee;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class EmployeeController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $employees = Employee::orderBy('name', 'asc')->paginate(10);

            return view('employees.index', [
                'employees' => $employees,
                'sidebar' => 'colaboradores'
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('employees.create', [
                'sidebar' => 'colaboradores'
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(EmployeeRequest $request)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $employee = Employee::create([
                    'name' => $request->name,
                    'job_title' => $request->job_title,
                    'department' => $request->department,
                ]);

                Log::info('Colaborador cadastardo', ['id' => $employee->id, 'action_user_id' => Auth::id()]);

                Db::commit();

                return redirect()->route('employee.index')->with('success', 'Colaborador cadastrado com sucesso!');
            } catch (\Exception $e) {
                Log::error('Colaborador não cadastrado', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);;

                DB::rollBack();

                return back()->withInput()->with('error', 'Colaborador não cadastrado');
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(Employee $employee)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Employee $employee)
        {
            return view('employees.edit', [
                'employee' => $employee,
                'sidebar' => 'colaboradores'
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(EmployeeRequest $request, Employee $employee)
        {
            $request->validated();

            DB::beginTransaction();

            try {
                $employee->update([
                    'name' => $request->name,
                    'job_title' => $request->job_title,
                    'department' => $request->department,
                ]);

                Log::info('Colaborador atualizado', ['id' => $employee->id, 'action_user_id' => Auth::id()]);

                DB::commit();

                return redirect()->route('employee.index')->with('success', 'Colaborador atualizado com sucesso!');
            } catch (\Exception $e) {
                Log::error('Colaborador não atualizado', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Colaborador não atualizado');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Employee $employee)
        {
            try {
                $employee->delete();

                Log::info('Colaborador excluído', ['id' => $employee->id, 'action_user_id' => Auth::id()]);

                return redirect()->route('employee.index')->with('success', 'Colaborador excluído com sucesso!');
            } catch (\Exception $e) {
                Log::error('Colaborador não excluído', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);
                return back()->with('error', 'Colaborador não excluído');
            }
        }
    }

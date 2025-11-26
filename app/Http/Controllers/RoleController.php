<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Spatie\Permission\Models\Role;

    class RoleController extends Controller
    {
        public function index()
        {
            $roles = Role::orderBy('name', 'asc')->paginate(10);

            return view('roles.index', [
                'roles' => $roles,
                'sidebar' => 'roles'
            ]);
        }

        public function create()
        {
            return view('roles.create', [
                'sidebar' => 'roles'
            ]);
        }

        public function store(Request $request)
        {
            $request->validate(
                [
                    'name' => 'required|unique:roles,name'
                ],
                [
                    'name.required' => 'Campo obrigatório',
                    'name.unique' => 'Papel já existe'
                ]
            );

            try {
                DB::beginTransaction();

                $role = Role::create([
                    'name' => $request->name,
                    'guard_name' => 'web'
                ]);

                Log::info('Papel cadastrado', ['id' => $role->id, 'action_user_id' => auth()->id()]);

                DB::commit();

                return redirect()->route('role.index')->with('success', 'Papel cadastrado com sucesso!');
            } catch (\Exception $e) {
                Log::info('Erro ao cadastrar papel', ['error' => $e->getMessage(), 'action_user_id' => auth()->id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Erro ao cadastrar papel');
            }
        }

        public function edit(Role $role)
        {
            return view('roles.edit', [
                'role' => $role,
                'sidebar' => 'roles'
            ]);
        }

        public function update(Request $request, Role $role)
        {
            $request->validate(
                [
                    'name' => 'required|unique:roles,name,' . $role->id
                ],
                [
                    'name.required' => 'Campo obrigatório',
                    'name.unique' => 'Papel já existe'
                ]
            );

            try {
                DB::beginTransaction();

                $role->update(['name' => $request->name]);

                Log::info('Papel atualizado', ['id' => $role->id, 'action_user_id' => auth()->id()]);

                Db::commit();

                return redirect()->route('role.index')->with('success', 'Papel atualizado com sucesso!');
            } catch (\Exception $e) {
                Log::info('Erro ao atualizar papel', ['error' => $e->getMessage(), 'action_user_id' => auth()->id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Erro ao atualizar papel');
            }

        }

        public function destroy(Role $role)
        {
            try {
                $role->delete();

                Log::info('Papel deletado', ['id' => $role->id, 'action_user_id' => auth()->id()]);

                return redirect()->route('role.index')->with('success', 'Papel excluído com sucesso!');
            } catch (\Exception $e) {

                Log::info('Erro ao excluir papel', ['error' => $e->getMessage(), 'action_user_id' => auth()->id()]);
                return back()->with('error', 'Erro ao excluir papel');
            }
        }
    }

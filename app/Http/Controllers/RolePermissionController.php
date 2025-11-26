<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RolePermissionController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(Role $role)
        {
            if ($role->name == 'Super Admin') {
                return redirect()->route('role.index')->with('error', 'Acesso exclusivo para Marciel A. Varini');
            }

            // Recuperar as permissões "id" do papel
            $permissionRoles = $role->permissions()->pluck('permission_id')->all();

            // Recuperar todas as permissões do banco de dados
            $permissions = Permission::orderBy('name', 'ASC')->get();

            return view('rolepermissions.index', [
                'permissionRoles' => $permissionRoles,
                'sidebar' => 'roles',
                'permissions' => $permissions,
                'role' => $role
            ]);
        }

        public function update(Request $request, Role $role)
        {
            // Obter a permissão específica com base no ID fornecido em $request->permission
            $permission = Permission::find($request->permission);

            // Verificar se a permissão foi encontrada
            if (!$permission) {

                Log::info('Permissão do Administrador não pode ser acessada!', ['user_action_id' => Auth::id()]);

                return redirect()->route('role-permission.update', ['role' => $role->id, 'permission' => $permission->permission])->with('error', 'Permissão do Administrador não pode ser acessada!');
            }

            // Verificar se a permissão já está associada ao papel
            if ($role->permissions->contains($permission)) {

                // Remover a permissão do papel  "Bloqueado"
                $role->revokePermissionTo($permission);

                // Salvar o log
                Log::info('Bloquear permissão do papel', ['user_action_id' => Auth::id(), 'permissao' => $request->permission]);

                // Redirecionar o usuário
                return redirect()->route('role-permission.index', ['role' => $role->id])->with('success', 'Permissão bloqueado com sucesso!');
            } else {
                // Adicionar a permissão do pepel "Liberado"
                $role->givePermissionTo($permission);

                // Salvar o log
                Log::info('Liberar permissão do papel', ['user_action_id' => Auth::id(), 'permissao' => $request->permission]);

                // Redirecionar o usuário
                return redirect()->route('role-permission.index', ['role' => $role->id])->with('success', 'Permissão liberada com sucesso!');
            }
        }

    }

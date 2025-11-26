<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UserCreateRequest;
    use App\Http\Requests\UserUpdateRequest;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Str;
    use Spatie\Permission\Models\Role;


    class UserController extends Controller
    {
        public function index()
        {
            $users = User::orderBy('name', 'asc')->paginate(10);

            return view('users.index', [
                'users' => $users,
                'sidebar' => 'users'
            ]);
        }

        public function create()
        {
            // Recuperar todas as permissões do banco de dados
            $roles = Role::pluck('name')->all();

            return view('users.create', [
                'sidebar' => 'users',
                'roles' => $roles,
            ]);
        }

        public function store(UserCreateRequest $request)
        {

            // Validar o formulário
            $request->validated();

            // Iniciar a transação
            DB::beginTransaction();

            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => Str::lower($request->email),
                    'password' => $request->password,
                ]);

                // Atribuir o papael da request ao usuário
                $user->assignRole($request->role);

                // Salvar o log
                Log::info('usuário cadastrado', ['id' => $user->id, 'action_user_id' => Auth::id()]);

                //Operação concluída
                DB::commit();

                return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso');

            } catch (\Exception $e) {
                Log::error('Usuário não cadastrado', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Usuário não cadastrado');
            }
        }

        public function edit(User $user)
        {
            // Recuperar todos os papéis do banco de dados
            $roles = Role::pluck('name')->all();

            // Recuperar o papel do usuario
            $userRoles = $user->roles()->pluck('name')->first();

            return view('users.edit', [
                'user' => $user,
                'sidebar' => 'users',
                'roles' => $roles,
                'userRoles' => $userRoles
            ]);
        }

        public function update(User $user, UserUpdateRequest $request)
        {
            $request->validated();

            $user->update([
                'name' => $request->name,
                'email' => Str::lower($request->email),
                'password' => $request->password ?? $user->password,
            ]);

            // Sincronizar o papel do usuário
            $user->syncRoles($request->role);

            return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso!');
        }

        public function destroy(User $user)
        {
            // Remove todos os papéis do usuário
            $user->syncRoles([]);
            
            $user->delete();

            Log::info('usuário excluído', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        }
    }

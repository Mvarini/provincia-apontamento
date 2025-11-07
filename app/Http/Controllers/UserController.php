<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UserCreateRequest;
    use App\Http\Requests\UserUpdateRequest;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Str;


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
            return view('users.create', [
                'sidebar' => 'users'
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
            return view('users.edit', [
                'user' => $user,
                'sidebar' => 'users'
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

            return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso!');
        }

        public function destroy(User $user)
        {
            $user->delete();

            Log::info('usuário excluído', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        }
    }

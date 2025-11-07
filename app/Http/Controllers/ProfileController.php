<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\ProfileUpdateRequest;
    use App\Models\Profile;
    use App\Models\User;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Storage;

    class ProfileController extends Controller
    {
        public function create(User $user)
        {
            $genders = ['Masculino', 'Feminino'];

            $user->load('profile');

            return view('profiles.create', [
                'user' => $user,
                'genders' => $genders,
            ]);
        }

        public function update(User $user, ProfileUpdateRequest $request)
        {

            $request->validated();

            if ($request->hasfile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->file('image')->store('profiles', 'public');

                if ($user->profile->image) {
                    Storage::disk('public')->delete($user->profile->image);
                }
            }

            Profile::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nickname' => $request->nickname,
                'birthday' => Carbon::parse(str_replace(['-', '/'], ['', '-'], $request->birthday))->format('Y-m-d'),
                'phone' => $request->phone,
                'gender' => $request->gender,
//                'image' => $requestImage ?? $request->image,
                'image' => $request->hasFile('image') ? $requestImage : $user->profile->image,
            ]);

            return redirect()->route('user.index')->with('success', 'Perfil atualizado com sucesso!');
        }
    }

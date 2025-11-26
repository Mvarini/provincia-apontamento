<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $superAdmin = User::firstOrCreate(
                ['email' => 'marciel_mav@hotmail.com'],
                [
                    'name' => 'Marciel Alessandro Varini',
                    'email' => 'marciel_mav@hotmail.com',
                    'password' => Hash::make('123456789', ['rounds' => 12]),
                ]
            );
            // Atribuir o papel ao usuário criado
            $superAdmin->assignRole('Super Admin');

            $admin = User::firstOrCreate(
                ['email' => 'caio@email.com'],
                [
                    'name' => 'Caio da Silva',
                    'email' => 'caio@email.com',
                    'password' => Hash::make('123456789', ['rounds' => 12]),
                ]
            );
            // Atribuir o papel
            $admin->assignRole('Admin');

            $invited = User::firstOrCreate(
                ['email' => 'kaua@email.com'],
                [
                    'name' => 'kauã da Silva',
                    'email' => 'kaua@email.com',
                    'password' => Hash::make('123456789', ['rounds' => 12]),
                ]
            );
            // Atribuir o papel
            $invited->assignRole('Convidado');
        }
    }

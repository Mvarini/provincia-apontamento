<?php

    namespace Database\Seeders;

    use App\Models\Machine;
    use Illuminate\Database\Seeder;

    class MachineSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $machines = [
                'Artist 1',
                'Artist 2',
                'Artist 3',
                'Double Jet 1',
                'Double Jet 2',
                'Respigadeira 1',
                'Respigadeira 2',
                'Rover B71',
                'Rover B72',
                'Rover B4',
            ];

            foreach ($machines as $machine) {
                Machine::firstOrCreate(
                    ['name' => $machine],
                    ['name' => $machine]
                );
            }
        }
    }

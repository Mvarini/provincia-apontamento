<?php

    namespace Database\Seeders;

    use App\Models\Ppe;
    use Illuminate\Database\Seeder;

    class PpeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $ppes = [
                'Botina',
                'Luva de couro',
                'Luva maxi',
                'Luva pu',
                'Óculos',
                'Protetor auditivo tipo concha',
                'Protetor auditivo tipo plug',
                'Respirador PFF2',
                'Uniforme'
            ];

            foreach ($ppes as $ppe) {
                Ppe::firstOrCreate(
                    ['name' => $ppe],
                    ['name' => $ppe]
                );
            }
        }
    }

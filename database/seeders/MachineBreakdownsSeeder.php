<?php

    namespace Database\Seeders;

    use App\Models\MachineBreakdown;
    use Illuminate\Database\Seeder;

    class MachineBreakdownsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $machineBreakdowns = [
                'Afiação de ferramentas',
                'Embalagem de Astec',
                'Embalagem de reforma',
                'Falta de espaço',
                'Falta de matéria prima',
                'Falta de peças',
                'Falta de pessoal',
                'Falta de programação',
                'Inspeção de qualidade',
                'Limpeza de máquina',
                'Limpeza do setor',
                'Manutenção corretiva',
                'Manutenção preventiva',
                'Máquina travada',
                'Movimentação de material',
                'Movimentação de pessoal',
                'Parada para eventual',
                'Protótipo',
                'Queda/Falta de energia',
                'Retrabalho',
                'Reunião/Treinamento',
                'Setup',
            ];

            foreach ($machineBreakdowns as $machineBreakdown) {
                MachineBreakdown::firstOrCreate(
                    ['name' => $machineBreakdown],
                    ['name' => $machineBreakdown]
                );
            }
        }
    }

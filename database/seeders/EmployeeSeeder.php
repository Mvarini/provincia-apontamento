<?php

    namespace Database\Seeders;

    use App\Models\Employee;
    use Illuminate\Database\Seeder;

    class EmployeeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $employees = [
                'Andressa Perpetua Costa',
                'Caio Alvarenga Barbosa',
                'Christian Paulo da Silva Santana',
                'Claudia Olivia Alves Peixoto Evaristo',
                'Cleber Alvarenga da Silva',
                'Daiane de Souva Barbosa',
                'Daniel Fernandes',
                'Edjania de Sousa Romero',
                'Gabriel Henrique Ferreira Ponte',
                'Danilo Henrique Bolzoni Lopes',
                'Debora de Andrade Freitas',
                'João Vitor Cosmo dos Santos',
                'Joice Augusta da Silva',
                'Joice Fernanda Couto',
                'José Antônio do Nascimento',
                'José Carlos dos Santos',
                'Júlio Cezar Candido Correa',
                'Kauã Caio Molezin',
                'Kaue da Silva Dos Santos',
                'Leonardo Ferreira de Mello',
                'Lucas Marcena da Silva',
                'Marciel Alessandro Varini',
                'Marcos José Soler Peres',
                'Miquéias dos Santos Bezerra',
                'Mizael dos Santos Bezerra',
                'Murilo',
                'Paulo Henrique dos Santos',
                'Paulo Henrique Xavier',
                'Paulo Tiago Dionízio',
                'Sebastiana Santos de Matos'
            ];

            foreach ($employees as $employee) {
                Employee::firstOrCreate(
                    ['name' => $employee],
                    ['name' => $employee, 'job_title' => 'Auxiliar', 'department' => 'CNC']
                );
            }
        }
    }

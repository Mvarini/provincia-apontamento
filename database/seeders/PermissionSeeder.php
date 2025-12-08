<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Permission;

    class PermissionSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $permissions = [
                ['title' => 'Página inicial', 'name' => 'home.index'],
                ['title' => 'Listar usuários', 'name' => 'user.index'],
                ['title' => 'Cadastrar usuário', 'name' => 'user.create'],
                ['title' => 'Editar usuário', 'name' => 'user.edit'],
                ['title' => 'Deletar usuário', 'name' => 'user.destroy'],
                ['title' => 'Cadastrar perfil', 'name' => 'profile.create'],
                ['title' => 'Atualizar perfil', 'name' => 'profile.update'],
                ['title' => 'Listar produtos', 'name' => 'product.index'],
                ['title' => 'Cadastrar produto', 'name' => 'product.create'],
                ['title' => 'Editar produto', 'name' => 'product.edit'],
                ['title' => 'Deletar produto', 'name' => 'product.destroy'],
                ['title' => 'Visual caderno técnico', 'name' => 'product.preview'],
                ['title' => 'Download caderno técnico', 'name' => 'product.download'],
                ['title' => 'Listar máquinas', 'name' => 'machine.index'],
                ['title' => 'Cadastrar máquinas', 'name' => 'machine.create'],
                ['title' => 'Editar máquina', 'name' => 'machine.edit'],
                ['title' => 'Deletar máquina', 'name' => 'machine.destroy'],
                ['title' => 'Listar colaboradores', 'name' => 'employee.index'],
                ['title' => 'Cadastrar colaborador', 'name' => 'employee.create'],
                ['title' => 'Editar colaborador', 'name' => 'employee.edit'],
                ['title' => 'Deletar colaborador', 'name' => 'employee.destroy'],
                ['title' => 'Listar paradas da máquina', 'name' => 'machinebreakdown.index'],
                ['title' => 'Cadastrar parada da máquina', 'name' => 'machinebreakdown.create'],
                ['title' => 'Editar parada da máquina', 'name' => 'machinebreakdown.edit'],
                ['title' => 'Deletar parada da máquina', 'name' => 'machinebreakdown.destroy'],
                ['title' => 'Listar os apontamentos', 'name' => 'task.index'],
                ['title' => 'Cadastrar o apontamento', 'name' => 'task.create'],
                ['title' => 'Cadastrar o apontamento', 'name' => 'task.show'],
                ['title' => 'Editar o apontamento', 'name' => 'task.edit'],
                ['title' => 'Deletar o apontamento', 'name' => 'task.destroy'],
                ['title' => 'Download do apontamento', 'name' => 'task.report-task'],
                ['title' => 'Listar paradas do apontamento', 'name' => 'task-breakdown.index'],
                ['title' => 'Cadastrar parada do apontamento', 'name' => 'task-breakdown.create'],
                ['title' => 'Editar parada do apontamento', 'name' => 'task-breakdown.edit'],
                ['title' => 'Deletar parada do apontamento', 'name' => 'task-breakdown.destroy'],
                ['title' => 'Listar papéis', 'name' => 'role.index'],
                ['title' => 'Cadastrar papel', 'name' => 'role.create'],
                ['title' => 'Editar papel', 'name' => 'role.edit'],
                ['title' => 'Deletar papel', 'name' => 'role.destroy'],
                ['title' => 'Listar as permissões do papel', 'name' => 'role-permission.index'],
                ['title' => 'Editar as permissões do papel', 'name' => 'role-permission.update'],
                ['title' => 'Listar os EPIs', 'name' => 'ppe.index'],
                ['title' => 'Cadastrar EPI', 'name' => 'ppe.create'],
                ['title' => 'Editar EPI', 'name' => 'ppe.edit'],
                ['title' => 'Deletar EPI', 'name' => 'ppe.destroy'],
                ['title' => 'Listar movimentaçāo EPI', 'name' => 'ppe-movements.index'],
                ['title' => 'Cadastrar movimentaçāo EPI', 'name' => 'ppe-movements.create'],
                ['title' => 'Editar movimentaçāo EPI', 'name' => 'ppe-movements.edit'],
                ['title' => 'Deletar movimentaçāo EPI', 'name' => 'ppe-movements.destroy'],
                ['title' => 'Relatório movimentaçāo EPI', 'name' => 'ppe-movements.report'],
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(
                    ['name' => $permission['name'], 'title' => $permission['title']],
                    [
                        'name' => $permission['name'],
                        'title' => $permission['title'],
                        'guard_name' => 'web'
                    ]
                );
            }
        }
    }

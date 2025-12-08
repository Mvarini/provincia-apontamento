<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class RoleSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // Super Admin tem acesso a todas as rotas
            Role::firstOrCreate(
                ['name' => 'Super Admin'],
                ['name' => 'Super Admin']
            );

            // Administrador
            $admin = Role::firstOrCreate(
                ['name' => 'Admin'],
                ['name' => 'Admin']
            );
            // Cadastrar a permissão para o papel Administrador
            $admin->givePermissionTo([
                'home.index',
                'profile.create',
                'profile.update',
                'product.index',
                'product.create',
                'product.edit',
                'product.destroy',
                'product.preview',
                'product.download',
                'machine.index',
                'machine.create',
                'machine.edit',
                'machine.destroy',
                'employee.index',
                'employee.create',
                'employee.edit',
                'employee.destroy',
                'machinebreakdown.index',
                'machinebreakdown.create',
                'machinebreakdown.edit',
                'machinebreakdown.destroy',
                'task.index',
                'task.create',
                'task.show',
                'task.edit',
                'task.destroy',
                'task.report-task',
                'task-breakdown.index',
                'task-breakdown.create',
                'task-breakdown.edit',
                'task-breakdown.destroy',
                'ppe.index',
                'ppe.create',
                'ppe.edit',
                'ppe.destroy',
                'role.index',
                'role-permission.index',
                'user.index',
                'ppe-movements.index',
                'ppe-movements.create',
                'ppe-movements.edit',
                'ppe-movements.destroy',
                'ppe-movements.report',
            ]);

            // Convidado apenas visualiza as rotas
            $invited = Role::firstOrCreate(
                ['name' => 'Convidado'],
                ['name' => 'Convidado']
            );

            $invited->givePermissionTo([
                'home.index',
                'product.index',
                'machine.index',
                'employee.index',
                'machinebreakdown.index',
                'task.index',
                'task-breakdown.index',
                'ppe.index'
            ]);
        }
    }

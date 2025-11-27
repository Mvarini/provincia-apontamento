<?php

    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\MachineBreakdownController;
    use App\Http\Controllers\MachineController;
    use App\Http\Controllers\PpeController;
    use App\Http\Controllers\PpeMovementController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\RolePermissionController;
    use App\Http\Controllers\TaskBreakdownController;
    use App\Http\Controllers\TaskController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::middleware(['auth'])->group(function () {
//        Route::get('/', function () {
//            return view('dashboard');
//        })->name('dashboard');

        // DASHBOARD
        Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware('permission:home.index');

        // User
        Route::get('/users', [UserController::class, 'index'])->name('user.index')->middleware('permission:user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store')->middleware('permission:user.create');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.edit');
        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.edit');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:user.destroy');

        // PROFILE
        Route::get('/profile/{user}', [ProfileController::class, 'create'])->name('profile.create')->middleware('permission:profile.create');
        Route::put('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:profile.update');

        // PRODUCTS
        Route::get('/products', [ProductController::class, 'index'])->name('product.index')->middleware('permission:product.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create')->middleware('permission:product.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('product.store')->middleware('permission:product.create');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('permission:product.edit');
        Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('permission:product.edit');
        Route::delete('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('permission:product.destroy');
        Route::get('/products/preview/{product}', [ProductController::class, 'preview'])->name('product.preview')->middleware('permission:product.preview');
        Route::get('/products/download/{product}', [ProductController::class, 'download'])->name('product.download')->middleware('permission:product.download');

        // MACHINES
        Route::get('/machines', [MachineController::class, 'index'])->name('machine.index')->middleware('permission:machine.index');
        Route::get('/machines/create', [MachineController::class, 'create'])->name('machine.create')->middleware('permission:machine.create');
        Route::post('/machines/store', [MachineController::class, 'store'])->name('machine.store')->middleware('permission:machine.create');
        Route::get('/machines/edit/{machine}', [MachineController::class, 'edit'])->name('machine.edit')->middleware('permission:machine.edit');
        Route::put('/machines/update/{machine}', [MachineController::class, 'update'])->name('machine.update')->middleware('permission:machine.edit');
        Route::delete('/machines/destroy/{machine}', [MachineController::class, 'destroy'])->name('machine.destroy')->middleware('permission:machine.destroy');;

        // EMPLOYEES
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index')->middleware('permission:employee.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('permission:employee.create');
        Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employee.store')->middleware('permission:employee.create');
        Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('permission:employee.edit');
        Route::put('/employees/update/{employee}', [EmployeeController::class, 'update'])->name('employee.update')->middleware('permission:employee.edit');
        Route::delete('/employees/destroy/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware('permission:employee.destroy');

        // MACHINE BREAKDOWN
        Route::get('/machine-breakdowns', [MachineBreakdownController::class, 'index'])->name('machinebreakdown.index')->middleware('permission:machinebreakdown.index');
        Route::get('/machine-breakdowns/create', [MachineBreakdownController::class, 'create'])->name('machinebreakdown.create')->middleware('permission:machinebreakdown.create');
        Route::post('/machine-breakdowns/store', [MachineBreakdownController::class, 'store'])->name('machinebreakdown.store')->middleware('permission:machinebreakdown.create');
        Route::get('/machine-breakdowns/edit/{machineBreakdown}', [MachineBreakdownController::class, 'edit'])->name('machinebreakdown.edit')->middleware('permission:machinebreakdown.edit');
        Route::put('/machine-breakdowns/update/{machineBreakdown}', [MachineBreakdownController::class, 'update'])->name('machinebreakdown.update')->middleware('permission:machinebreakdown.edit');
        Route::delete('/machine-breakdowns/destroy/{machineBreakdown}', [MachineBreakdownController::class, 'destroy'])->name('machinebreakdown.destroy')->middleware('permission:machinebreakdown.destroy');

        // TASKS
        Route::get('/tasks', [TaskController::class, 'index'])->name('task.index')->middleware('permission:task.index');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create')->middleware('permission:task.create');
        Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store')->middleware('permission:task.create');
        Route::get('/tasks/show/{task}', [TaskController::class, 'show'])->name('task.show')->middleware('permission:task.show');
        Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('task.edit')->middleware('permission:task.edit');
        Route::put('/tasks/update/{task}', [TaskController::class, 'update'])->name('task.update')->middleware('permission:task.edit');
        Route::delete('/tasks/destroy/{task}', [TaskController::class, 'destroy'])->name('task.destroy')->middleware('permission:task.destroy');
        Route::get('/tasks/report', [TaskController::class, 'reportTask'])->name('task.report-task')->middleware('permission:task.report-task');


        // TASK_BREAKDOWN
        Route::get('/task-breakdowns/{task}', [TaskBreakdownController::class, 'index'])->name('task-breakdown.index')->middleware('permission:task-breakdown.index');
        Route::get('/task-breakdowns/create/{task}', [TaskBreakdownController::class, 'create'])->name('task-breakdown.create')->middleware('permission:task-breakdown.create');
        Route::post('/task-breakdowns/store', [TaskBreakdownController::class, 'store'])->name('task-breakdown.store')->middleware('permission:task-breakdown.create');
        Route::get('/task-breakdowns/edit/{taskBreakdown}', [TaskBreakdownController::class, 'edit'])->name('task-breakdown.edit')->middleware('permission:task-breakdown.edit');
        Route::put('/task-breakdowns/update/{taskBreakdown}', [TaskBreakdownController::class, 'update'])->name('task-breakdown.update')->middleware('permission:task-breakdown.edit');
        Route::delete('/task-breakdowns/destroy/{taskBreakdown}', [TaskBreakdownController::class, 'destroy'])->name('task-breakdown.destroy')->middleware('permission:task-breakdown.destroy');;

        // EPI
        Route::get('/ppes', [PpeController::class, 'index'])->name('ppe.index')->middleware('permission:ppe.index');
        Route::get('/ppes/create', [PpeController::class, 'create'])->name('ppe.create')->middleware('permission:ppe.create');
        Route::post('/ppes/store', [PpeController::class, 'store'])->name('ppe.store')->middleware('permission:ppe.create');
        Route::get('/ppes/edit/{ppe}', [PpeController::class, 'edit'])->name('ppe.edit')->middleware('permission:ppe.edit');
        Route::put('/ppes/update/{ppe}', [PpeController::class, 'update'])->name('ppe.update')->middleware('permission:ppe.edit');
        Route::delete('/ppes/destroy/{ppe}', [PpeController::class, 'destroy'])->name('ppe.destroy')->middleware('permission:ppe.destroy');

        // EPI MOVIMENTATION
        Route::get('/ppes/movements', [PpeMovementController::class, 'index'])->name('ppe-movements.index')->middleware('permission:ppe-movements.index');
        Route::get('/ppes/movements/create', [PpeMovementController::class, 'create'])->name('ppe-movements.create')->middleware('permission:ppe-movements.create');
        Route::post('/ppes/movements/store', [PpeMovementController::class, 'store'])->name('ppe-movements.store')->middleware('permission:ppe-movements.create');
        Route::get('/ppes/movements/edit/{ppeMovement}', [PpeMovementController::class, 'edit'])->name('ppe-movements.edit')->middleware('permission:ppe-movements.edit');
        Route::put('/ppes/movements/update/{ppeMovement}', [PpeMovementController::class, 'update'])->name('ppe-movements.update')->middleware('permission:ppe-movements.edit');
        Route::delete('/ppes/movements/destroy/{ppeMovement}', [PpeMovementController::class, 'destroy'])->name('ppe-movements.destroy')->middleware('permission:ppe-movements.destroy');;
        Route::get('/ppes/movements/report', [PpeMovementController::class, 'reportPpe'])->name('ppe-movements.report')->middleware('permission:ppe-movements.report');


        // ROLE
        Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role.create');
        Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role.create');
        Route::get('/role/edit/{role}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role.edit');
        Route::put('/role/update/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role.edit');
        Route::delete('/role/destroy/{role}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:role.destroy');

        // ROLE PERMISSION
        Route::get('/role/permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index')->middleware('permission:role-permission.index');
        Route::get('/role/permission/update/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update')->middleware('permission:role-permission.update');
    });




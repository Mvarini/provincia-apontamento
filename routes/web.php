<?php

    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\MachineController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::middleware(['auth'])->group(function () {
//        Route::get('/', function () {
//            return view('dashboard');
//        })->name('dashboard');

        // DASHBOARD
        Route::get('/', [HomeController::class, 'index'])->name('home.index');

        // User
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // PROFILE
        Route::get('/profile/{user}', [ProfileController::class, 'create'])->name('profile.create');
        Route::put('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');

        // PRODUCTS
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        // MACHINES
        Route::get('/machines', [MachineController::class, 'index'])->name('machine.index');
        Route::get('/machines/create', [MachineController::class, 'create'])->name('machine.create');
        Route::post('/machines/store', [MachineController::class, 'store'])->name('machine.store');
        Route::get('/machines/edit/{machine}', [MachineController::class, 'edit'])->name('machine.edit');
        Route::put('/machines/update/{machine}', [MachineController::class, 'update'])->name('machine.update');
        Route::delete('/machines/destroy/{machine}', [MachineController::class, 'destroy'])->name('machine.destroy');

        // EMPLOYEES
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/employees/update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/employees/destroy/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });




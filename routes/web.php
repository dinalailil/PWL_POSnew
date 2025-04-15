<?php
 
    use App\Http\Controllers\BarangController;
    use App\Http\Controllers\KategoriController;
    use App\Http\Controllers\LevelController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\WelcomeController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */
    
    
    // Route::get('/level', [LevelController::class, 'index']);
    // Route::get('/kategori', [KategoriController::class, 'index']);
    // Route::get('/user', [UserController::class, 'index']);
    // Route::get('/user/tambah', [UserController::class, 'tambah']);
    // Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
    // Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
    // Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
    // Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
    
    Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

    Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu

        Route::get('/', [WelcomeController::class,'index']);
    
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);              // Menampilkan halaman awal user
            Route::post('/list', [UserController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create', [UserController::class, 'create']);       // Menampilkan halaman form tambah user
            Route::post('/', [UserController::class, 'store']);             // Menyimpan data user baru
            Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']);          // Menyimpan data user baru Ajax
            Route::get('/{id}', [UserController::class, 'show']);           // Menampilkan detail user
            Route::get('/{id}/edit', [UserController::class, 'edit']);      // Menampilkan halaman form edit user
            Route::put('/{id}', [UserController::class, 'update']);         // Menyimpan perubahan data user
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);  // Menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //untuk tampilkan form confirm delete user ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //untuk delete user ajax
            Route::delete('/{id}', [UserController::class, 'destroy']);     // Menghapus data user
        });
            
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KategoriController::class, 'index']);
            Route::post('/list', [KategoriController::class, 'list']);
            Route::get('/create', [KategoriController::class, 'create']);
            Route::post('/', [KategoriController::class, 'store']);
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
            Route::post('/ajax', [KategoriController::class, 'store_ajax']);
            Route::get('/{id}', [KategoriController::class, 'show']);
            Route::get('/{id}/edit', [KategoriController::class, 'edit']);
            Route::put('/{id}', [KategoriController::class, 'update']);
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
            Route::delete('/{id}', [KategoriController::class, 'destroy']);
        });
        
        
        //Route::group(['prefix' => 'level'], function () {
        Route::middleware(['authorize:ADM']) ->group (function () {
            Route::get('/', [LevelController::class, 'index']);       // menampilkan halaman awal level
            Route::post('/list', [LevelController::class, 'list']);    // menampilkan data level dalam bentuk json untuk datatables
            Route::get('/create', [LevelController::class, 'create']);// menampilkan halaman form tambah level
            Route::post('/', [LevelController::class, 'store']);      // menyimpan data level baru
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);// menampilkan halaman form tambah level
            Route::post('/ajax', [LevelController::class, 'store_ajax']);      // menyimpan data level baru
            Route::get('/{id}', [LevelController::class, 'show']);    // menampilkan detail level
            Route::get('/{id}/edit', [LevelController::class, 'edit']);// menampilkan halaman form edit level
            Route::put('/{id}', [LevelController::class, 'update']);  // menyimpan perubahan data level
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);// menampilkan halaman form edit level
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);  // menyimpan perubahan data level
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);// menampilkan halaman form edit level
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);  // menyimpan perubahan data level
            Route::delete('/{id}', [LevelController::class, 'destroy']);// menghapus data level
        });
        
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index']);
            Route::post('/list', [SupplierController::class, 'list']);
            Route::get('/create', [SupplierController::class, 'create']);
            Route::post('/', [SupplierController::class, 'store']);
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
            Route::post('/ajax', [SupplierController::class, 'store_ajax']);
            Route::get('/{id}', [SupplierController::class, 'show']);
            Route::get('/{id}/edit', [SupplierController::class, 'edit']);
            Route::put('/{id}', [SupplierController::class, 'update']);
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
            Route::delete('/{id}', [SupplierController::class, 'destroy']);
        });
        
        Route::group(['prefix' => 'barang'], function () {
        // Route::middleware(['authorize:ADM,MNG'])->group(function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::post('/list', [BarangController::class, 'list']);
            Route::get('/create', [BarangController::class, 'create']);
            Route::post('/', [BarangController::class, 'store']);
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
            Route::post('/ajax', [BarangController::class, 'store_ajax']);
            Route::get('/{id}', [BarangController::class, 'show']);
            Route::get('/{id}/edit', [BarangController::class, 'edit']);
            Route::put('/{id}', [BarangController::class, 'update']);
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
            Route::delete('/{id}', [BarangController::class, 'destroy']);
        });        
});
    
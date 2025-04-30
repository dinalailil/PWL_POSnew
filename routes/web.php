<?php
 
    use App\Http\Controllers\LevelController;
    use App\Http\Controllers\KategoriController;
    use App\Http\Controllers\POSController;
    use App\Http\Controllers\WelcomeController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\BarangController;
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
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister']);

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu
    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function () { //hanya level admin yang dapat mengakses menu user
            Route::get('/user', [UserController::class, 'index']);              // Menampilkan halaman awal user
            Route::post('/user/list', [UserController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/user/create', [UserController::class, 'create']);       // Menampilkan halaman form tambah user
            Route::post('/user', [UserController::class, 'store']);             // Menyimpan data user baru
            Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // Menampilkan halaman form tambah user Ajax
            Route::post('/user/ajax', [UserController::class, 'store_ajax']);          // Menyimpan data user baru Ajax
            Route::get('/user/{id}', [UserController::class, 'show']);           // Menampilkan detail user
            Route::get('user/{id}/edit', [UserController::class, 'edit']);      // Menampilkan halaman form edit user
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);     // Menampilkan halaman form user Ajax
            Route::put('/user/{id}', [UserController::class, 'update']);         // Menyimpan perubahan data user
            Route::get('/user/{id}/show_ajax', [LevelController::class, 'show_ajax']);     // Menampilkan halaman form level Ajax
            Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // Menampilkan halaman form edit user Ajax
            Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']);  // Menyimpan perubahan data user Ajax
            Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //untuk tampilkan form confirm delete user ajax
            Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //untuk delete user ajax
            Route::delete('/user/{id}', [UserController::class, 'destroy']);     // Menghapus data user'
            Route::get('/user/import', [UserController::class, 'import']); // ajax form upload excel
            Route::post('/user/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
            Route::get('/user/export_excel',[UserController::class, 'export_excel']); //export excel
    });

    Route::middleware(['authorize:ADM'])->group(function () { //hanya level admin yang dapat mengakses menu level
            Route::get('/level', [LevelController::class, 'index']);              // Menampilkan halaman awal level
            Route::post('/level/list', [LevelController::class, 'list']);          // Menampilkan data level dalam bentuk json untuk datatables
            Route::get('/level/create', [LevelController::class, 'create']);       // Menampilkan halaman form tambah level
            Route::post('/level', [LevelController::class, 'store']);             // Menyimpan data level baru
            Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']);    // Menampilkan halaman form tambah user Ajax
            Route::post('/level/ajax', [LevelController::class, 'store_ajax']);          // Menyimpan data user baru Ajax
            Route::get('/level/{id}', [LevelController::class, 'show']);           // Menampilkan detail level
            Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);     // Menampilkan halaman form level Ajax
            Route::get('/level/{id}/edit', [LevelController::class, 'edit']);      // Menampilkan halaman form edit level
            Route::put('/level/{id}', [LevelController::class, 'update']);         // Menyimpan perubahan data level
            Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     // Menampilkan halaman form edit user Ajax
            Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']);  // Menyimpan perubahan data user Ajax
            Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::delete('/level/{id}', [LevelController::class, 'destroy']);     // Menghapus data level
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () { //hanya level admin,manager,staff yang dapat mengakses menu user
            Route::get('/kategori', [KategoriController::class, 'index']);              // Menampilkan halaman awal kategori
            Route::post('/kategori/list', [KategoriController::class, 'list']);          // Menampilkan data kategori dalam bentuk json untuk datatables
            Route::get('/kategori/create', [KategoriController::class, 'create']);       // Menampilkan halaman form tambah kategori
            Route::post('/kategori', [KategoriController::class, 'store']);             // Menyimpan data kategori baru
            Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);    // Menampilkan halaman form tambah kategori Ajax
            Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);          // Menyimpan data kategori baru Ajax
            Route::get('/kategori/{id}', [KategoriController::class, 'show']);           // Menampilkan detail kategori
            Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']);     // Menampilkan halaman form kategori Ajax
            Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);      // Menampilkan halaman form edit kategori
            Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     // Menampilkan halaman form edit kategori Ajax
            Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']);  // Menyimpan perubahan data kategori Ajax
            Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete kategori Ajax
            Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk hapus data kategori Ajax
            Route::put('/kategori/{id}', [KategoriController::class, 'update']);         // Menyimpan perubahan data kategori
            Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);     // Menghapus data kategori
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function () { //hanya level admin,manager yang dapat mengakses menu supplier
            Route::get('/supplier', [SupplierController::class, 'index']);              // Menampilkan halaman awal supplier
            Route::post('/supplier/list', [SupplierController::class, 'list']);          // Menampilkan data supplier dalam bentuk json untuk datatables
            Route::get('/supplier/create', [SupplierController::class, 'create']);       // Menampilkan halaman form tambah supplier
            Route::post('/supplier', [SupplierController::class, 'store']);             // Menyimpan data supplier baru
            Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']);    // Menampilkan halaman form tambah supplier Ajax
            Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);          // Menyimpan data supplier baru Ajax
            Route::get('/supplier/{id}', [SupplierController::class, 'show']);           // Menampilkan detail supplier
            Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);      // Menampilkan halaman form edit supplier
            Route::put('/supplier/{id}', [SupplierController::class, 'update']);         // Menyimpan perubahan data supplier
            Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']);     // Menampilkan halaman form supplier Ajax
            Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     // Menampilkan halaman form edit supplier Ajax
            Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']);  // Menyimpan perubahan data supplier Ajax
            Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete supplier Ajax
            Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data supplier Ajax
            Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);     // Menghapus data supplier
            Route::get('/supplier/import', [SupplierController::class, 'import']); //ajax form upload excel
            Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']); //ajax import excel
            Route::get('/supplier/export_excel',[SupplierController::class, 'export_excel']); //export excel
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () { //hanya level admin,manager,staff yang dapat mengakses menu barang
            Route::get('/barang', [BarangController::class, 'index']);              // Menampilkan halaman awal barang
            Route::post('/barang/list', [BarangController::class, 'list']);          // Menampilkan data barang dalam bentuk json untuk datatables
            Route::get('/barang/create', [BarangController::class, 'create']);       // Menampilkan halaman form tambah barang
            Route::post('/barang', [BarangController::class, 'store']);             // Menyimpan data barang baru
            Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);    // Menampilkan halaman form tambah barang Ajax
            Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);          // Menyimpan data barang baru Ajax
            Route::get('/barang/{id}', [BarangController::class, 'show']);           // Menampilkan detail barang
            Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);      // Menampilkan halaman form edit barang
            Route::put('/barang/{id}', [BarangController::class, 'update']);         // Menyimpan perubahan data barang
            Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);     // Menampilkan halaman form barang Ajax
            Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     // Menampilkan halaman form edit barang Ajax
            Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);  // Menyimpan perubahan data barang Ajax
            Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete barang Ajax
            Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data barang Ajax
            Route::delete('/barang/{id}', [BarangController::class, 'destroy']);     // Menghapus data barang
            Route::get('/barang/import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
            Route::get('/barang/export_excel',[BarangController::class, 'export_excel']); //export excel
    });
});
<?php
 
 namespace App\Http\Controllers;
 
 use App\Models\SupplierModel;
 use Illuminate\Http\Request;
 use Yajra\DataTables\Facades\DataTables;
 
 class SupplierController extends Controller
 {
     // Menampilkan halaman awal supplier
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Supplier',
             'list'  => ['Home', 'Supplier']
         ];
 
         $page = (object) [
             'title' => 'Daftar Supplier yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'supplier';
 
         $supplier = SupplierModel::all();
 
         return view('supplier.index', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
     }
 
     // Ambil data supplier dalam bentuk JSON untuk DataTables
     public function list()
     {
         $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama');
 
         return DataTables::of($supplier)
             ->addIndexColumn()
             ->addColumn('aksi', function ($supplier) {
                 $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                 $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                 $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
                     . csrf_field() . method_field('DELETE') .
                     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                 return $btn;
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }
 
     // Form tambah supplier
     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Supplier',
             'list'  => ['Home', 'Supplier', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah Supplier baru'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.create', compact('breadcrumb', 'page', 'activeMenu'));
     }
 
     // Simpan supplier baru
     public function store(Request $request)
     {
         $request->validate([
             'supplier_kode' => 'required|string|max:20',
             'supplier_nama' => 'required|string|max:100',
         ]);
 
         SupplierModel::create([
             'supplier_kode' => $request->supplier_kode,
             'supplier_nama' => $request->supplier_nama,
         ]);
 
         return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
     }
 
     // Detail supplier
     public function show(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         $breadcrumb = (object) [
             'title' => 'Detail Supplier',
             'list'  => ['Home', 'Supplier', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail Supplier'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.show', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
     }
 
     // Form edit supplier
     public function edit(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         $breadcrumb = (object) [
             'title' => 'Edit Supplier',
             'list'  => ['Home', 'Supplier', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit Supplier'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.edit', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
     }
 
     // Update supplier
     public function update(Request $request, string $id)
     {
         $request->validate([
             'supplier_kode' => 'required|string|max:20',
             'supplier_nama' => 'required|string|max:100',
         ]);
 
         SupplierModel::find($id)->update([
             'supplier_kode' => $request->supplier_kode,
             'supplier_nama' => $request->supplier_nama,
         ]);
 
         return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
     }
 
     // Hapus supplier
     public function destroy(string $id)
     {
         $check = SupplierModel::find($id);
 
         if (!$check) {
             return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
         }
 
         try {
             SupplierModel::destroy($id);
             return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terkait dengan data lain');
         }
     }
 }
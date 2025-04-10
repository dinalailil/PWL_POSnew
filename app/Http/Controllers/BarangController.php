<?php
  
    namespace App\Http\Controllers;
  
    use App\Models\KategoriModel;
    use App\Models\BarangModel;
    use Illuminate\Http\Request;
    use Yajra\DataTables\Facades\DataTables;
    use Illuminate\Support\Facades\Validator;

        class BarangController extends Controller
        {
         //Menampilkan halaman awal user
        public function index()
        {
            $breadcrumb = (object) [
                'title' => 'Daftar Barang',
                'list'  => ['Home', 'Barang']
            ];
      
          $page = (object) [
              'title' => 'Daftar barang yang terdaftar dalam sistem'
          ];
      
          $activeMenu = 'barang'; // set menu yang sedang aktif
      
          $kategori = KategoriModel::all(); //ambil data kategori untuk filter kategori
      
          return view('barang.index', [
              'breadcrumb' => $breadcrumb,
              'page'       => $page,
              'kategori'   => $kategori,
              'activeMenu' => $activeMenu
          ]);
      }      
  
      // Ambil data barang dalam bentuk json untuk datatables
      public function list(Request $request)
      {
        
        // $barang = BarangModel::with(['kategori']);

          $barang = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
              ->with(['kategori']); // Menggunakan array untuk multiple with
  
          // Filter data barang berdasarkan kategori_id
          if ($request->kategori_id) {
              $barang->where('kategori_id', $request->kategori_id);
          }
  
          return DataTables::of($barang)
              // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
              ->addIndexColumn()
              ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                //   $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                //   $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                //   $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/' . $barang->barang_id).'">'
                //       . csrf_field() . method_field('DELETE') .
                //       '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                //   return $btn;
                $btn  = '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
              })
              ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
              ->make(true);
      }
  
      // Menampilkan halaman form tambah barang
      public function create()
      {
          $breadcrumb = (object) [
              'title' => 'Tambah Barang',
              'list'  => ['Home', 'Barang', 'Tambah']
          ];
  
          $page = (object) [
              'title' => 'Tambah Barang baru'
          ];
  
          $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
          $activeMenu = 'barang';       // set menu yang sedang aktif
  
          return view('barang.create', [
              'breadcrumb' => $breadcrumb, 
              'page'       => $page, 
              'kategori'   => $kategori,
              'activeMenu' => $activeMenu
          ]);
      }
  
      public function store(Request $request)
      {
          // Validasi input
          $request->validate([
              'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
              'barang_nama' => 'required|string|max:100',  // barang_nama harus diisi, berupa string, dan maksimal 100 karakter
              'harga_beli'  => 'required|integer',
              'harga_jual'  => 'required|integer',
              'kategori_id' => 'required|integer',
              
          ]);
  
          // Menyimpan data user baru
          BarangModel::create([
              'barang_kode' => $request->barang_kode,
              'barang_nama' => $request->barang_nama,
              'harga_beli'  => $request->harga_beli,
              'harga_jual'  => $request->harga_jual,
              'kategori_id' => $request->kategori_id,
              
          ]);
  
          // Redirect ke halaman barang dengan pesan sukses
          return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
      }
  
      // Menampilkan detail barang
      public function show(string $id)
      {
          $barang = BarangModel::with(['kategori'])->find($id);
  
          $breadcrumb = (object) [
              'title' => 'Detail barang',
              'list'  => ['Home', 'barang', 'Detail']
          ];
  
          $page = (object) [
              'title' => 'Detail barang'
          ];
  
          $activeMenu = 'barang'; // set menu yang sedang aktif
  
          return view('barang.show', [
              'breadcrumb' => $breadcrumb, 
              'page' => $page, 
              'barang' => $barang, 
              'activeMenu' => $activeMenu
          ]);
      }
  
      // Menampilkan halaman form edit barang
      public function edit(string $id)
      {
          $barang = BarangModel::find($id);
          $kategori = KategoriModel::all();
  
          $breadcrumb = (object) [
              'title' => 'Edit Barang',
              'list'  => ['Home', 'Barang', 'Edit']
          ];
  
          $page = (object) [
              'title' => 'Edit barang'
          ];
  
          $activeMenu = 'barang'; // set menu yang sedang aktif
  
          return view('barang.edit', [
              'breadcrumb' => $breadcrumb, 
              'page' => $page, 
              'barang' => $barang,
              'kategori' => $kategori,
              'activeMenu' => $activeMenu
          ]);
      }
  
      // Menyimpan perubahan data user
      public function update(Request $request, string $id)
      {
          $request->validate([
              'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' .$id.',barang_id',
              'barang_nama' => 'required|string|max:100',
              'harga_beli'  => 'required|integer',
              'harga_jual'  => 'required|integer',
              'kategori_id' => 'required|integer',
          ]);
  
          BarangModel::find($id)->update([
              'barang_kode' => $request->barang_kode,
              'barang_nama' => $request->barang_nama,
              'harga_beli'  => $request->harga_beli,
              'harga_jual'  => $request->harga_jual,
              'kategori_id' => $request->kategori_id,
          ]);
  
          return redirect('/barang')->with('success', 'Data barang berhasil diubah');
      }
  
      // Menghapus data barang
      public function destroy(string $id)
      {
          $check = BarangModel::find($id);
          if (!$check) {    // untuk mengecek apakah data barang dengan id yang dimaksud ada atau tidak
              return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
          }
  
          try{
              BarangModel::destroy($id);    // Hapus data barang
  
              return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
          }catch (\Illuminate\Database\QueryException $e){
              // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
              return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
          }
      }
      public function create_ajax()
      {
          $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
          return view('barang.create_ajax', compact('kategori'));
      }
  
      public function store_ajax(Request $request)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $rules = [
                  'kategori_id' => 'required|integer',
                  'barang_kode' => 'required|string|unique:m_barang,barang_kode',
                  'barang_nama' => 'required|string|max:100',
                  'harga_beli'  => 'required|numeric',
                  'harga_jual'  => 'required|numeric'
              ];
  
              $validator = Validator::make($request->all(), $rules);
  
              if ($validator->fails()) {
                  return response()->json([
                      'status' => false,
                      'message' => 'Validasi Gagal',
                      'msgField' => $validator->errors(),
                  ]);
              }
  
              BarangModel::create($request->all());
              return response()->json([
                  'status' => true,
                  'message' => 'Data barang berhasil disimpan'
              ]);
          }
          return redirect('/');
      }
  
      public function edit_ajax(string $id)
      {
          $barang = BarangModel::find($id);
          $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
          return view('barang.edit_ajax', compact('barang', 'kategori'));
      }
  
      public function update_ajax(Request $request, $id)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $rules = [
                  'kategori_id' => 'required|integer',
                  'barang_kode' => 'required|string|unique:m_barang,barang_kode,'.$id.',barang_id',
                  'barang_nama' => 'required|string|max:100',
                  'harga_beli'  => 'required|numeric',
                  'harga_jual'  => 'required|numeric'
              ];
  
              $validator = Validator::make($request->all(), $rules);
  
              if ($validator->fails()) {
                  return response()->json([
                      'status'   => false,
                      'message'  => 'Validasi gagal.',
                      'msgField' => $validator->errors()
                  ]);
              }
  
              $barang = BarangModel::find($id);
              if ($barang) {
                  $barang->update($request->all());
                  return response()->json([
                      'status'  => true,
                      'message' => 'Data berhasil diperbarui'
                  ]);
              }
  
              return response()->json([
                  'status'  => false,
                  'message' => 'Data tidak ditemukan'
              ]);
          }
          return redirect('/');
      }
  
      public function confirm_ajax(string $id)
       {
           $barang = BarangModel::with('kategori')->find($id);
   
           return view('barang.confirm_ajax', ['barang' => $barang]);
       }
  
      public function delete_ajax(Request $request, $id)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $barang = BarangModel::find($id);
              if ($barang) {
                  $barang->delete();
                  return response()->json([
                      'status'  => true,
                      'message' => 'Data berhasil dihapus'
                  ]);
              }
  
              return response()->json([
                  'status'  => false,
                  'message' => 'Data tidak ditemukan'
              ]);
          }
          return redirect('/');
      }
}
<?php

namespace App\Http\Controllers;
 
 use App\Models\KategoriModel;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Validator;
 use Yajra\DataTables\Facades\DataTables;
 
 class KategoriController extends Controller
 {
public function index(){
         // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
         // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.' baris'; 
 
        //  $data = DB::table('m_kategori')->get();
        //  return view('categories', ['data' => $data]);
         // $data = DB::table('m_kategori')->get();
         // return view('kategori', ['data' => $data]);
 
         $breadcrumb = (object) [
             'title' => 'Daftar Kategori',
             'list'  => ['Home', 'Kategori']
         ];
 
         $page = (object) [
             'title' => 'Daftar Kategori yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'kategori'; // set menu yang sedang aktif
 
        //  $kategori = KategoriModel::all(); //ambil data kategori untuk filter kategori
 
         return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
     }
 
      // Ambil data kategori dalam bentuk json untuk datatables
      public function list()
      {
          $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
  
          return DataTables::of($kategori)
              // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
              ->addIndexColumn()
              ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
                //   $btn = '<a href="'.url('/kategori/' . $kategori->id).'" class="btn btn-info btn-sm">Detail</a> ';
                //   $btn .= '<a href="'.url('/kategori/' . $kategori->id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                //   $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kategori/' . $kategori->kategori_id).'">'
                //       . csrf_field() . method_field('DELETE') .
                //       '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                //   return $btn;
                $btn  = '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
              })
              ->rawColumns(['aksi'])
              ->make(true);
      }
  
      // Menampilkan halaman form tambah kategori
      public function create()
      {
          $breadcrumb = (object) [
              'title' => 'Tambah Kategori',
              'list'  => ['Home', 'Kategori', 'Tambah']
          ];
  
          $page = (object) [
              'title' => 'Tambah Kategori baru'
          ];
  
          //$kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
          $activeMenu = 'kategori';       // set menu yang sedang aktif
  
          return view('kategori.create', [
              'breadcrumb' => $breadcrumb, 
              'page' => $page, 
              //'kategori' => $kategori, 
              'activeMenu' => $activeMenu
          ]);
      }
  
      public function store(Request $request)
      {
          // Validasi input
          $request->validate([
              'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode', // kategori_id harus diisi, string, maksimal 10 karakter, dan unik di tabel m_kategori kolom kategori_kode
              'kategori_nama' => 'required|string|max:100'  // nama harus diisi, berupa string, dan maksimal 100 karakter
          ]);
  
          // Menyimpan data kategori baru
        //   KategoriModel::create([
        //       'kategori_kode' => $request->kategori_kode,
        //       'kategori_nama' => $request->kategori_nama
        //   ]);
        KategoriModel::create($request->all());
  
          // Redirect ke halaman kategori dengan pesan sukses
          return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
      }
  
      // Menampilkan detail kategori
      public function show(string $id)
      {
          $kategori = KategoriModel::findOrFail($id);
  
          $breadcrumb = (object) [
              'title' => 'Detail Kategori',
              'list'  => ['Home', 'Kategori', 'Detail']
          ];
  
          $page = (object) [
              'title' => 'Detail Kategori'
          ];
  
          $activeMenu = 'kategori'; // set menu yang sedang aktif
  
          return view('kategori.show', [
              'breadcrumb' => $breadcrumb, 
              'page' => $page, 
              'kategori' => $kategori, 
              'activeMenu' => $activeMenu
          ]);
      }
  
      // Menampilkan halaman form edit kategori
      public function edit(string $id)
      {
          $kategori = KategoriModel::findOrFail($id); // Ambil data kategori yang akan diedit
  
          $breadcrumb = (object) [
              'title' => 'Edit Kategori',
              'list'  => ['Home', 'Kategori', 'Edit']
          ];
  
          $page = (object) [
              'title' => 'Edit Kategori'
          ];
  
          $activeMenu = 'kategori'; // set menu yang sedang aktif
  
          return view('kategori.edit', [
              'breadcrumb' => $breadcrumb,
              'page' => $page,
              'kategori' => $kategori,
              'activeMenu' => $activeMenu
          ]);
      }
  
      // Menyimpan perubahan data kategori
      public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:255|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:255'
        ]);

        $kategori = KategoriModel::findOrFail($id);
        $kategori->update($request->all());

        return redirect('/kategori')->with('success', 'Data kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);
        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data yang anda cari tidak ditemukan'
            ]);
        }

        $kategori->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil dihapus'
        ]);
    }

    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'kategori_nama' => 'required|string|unique:m_kategori,kategori_nama|min:3|max:100'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            KategoriModel::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data kategori berhasil disimpan']);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', compact('kategori'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'kategori_nama' => 'required|string|unique:m_kategori,kategori_nama,'.$id.',kategori_id|min:3|max:100'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal.', 'msgField' => $validator->errors()]);
            }

            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
            }
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
     {
         $kategori = KategoriModel::find($id);
 
         if (!$kategori) {
             return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
         }
 
         return view('kategori.confirm_ajax', ['kategori' => $kategori]);
     }

     public function delete_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $kategori = KategoriModel::find($id);
 
             if ($kategori) {
                 $kategori->delete();
 
                 return response()->json([
                     'status' => true,
                     'message' => 'Data berhasil dihapus'
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                     'message' => 'Data tidak ditemukan'
                 ]);
             }
         }
 
         return redirect('/');
     }
 }
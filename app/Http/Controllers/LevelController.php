<?php

namespace App\Http\Controllers;
 
 use App\Models\LevelModel;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Validator;
 use Yajra\DataTables\Facades\DataTables;
 
 class LevelController extends Controller
 {
    public function index(){
         // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
         // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row. ' baris';
 
        //  $data = DB::select('select * from m_level');
        //  return view('level', ['data' => $data]);
         // $data = DB::select('select * from m_level');
         // return view('level', ['data' => $data]);
 
         $breadcrumb = (object) [
             'title' => 'Daftar Level',
             'list'  => ['Home', 'Level']
         ];
 
         $page = (object) [
             'title' => 'Daftar level yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'level'; // set menu yang sedang aktif
         $level = LevelModel::all(); //ambil data level untuk filter level
 
         return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
 
     // Ambil data level dalam bentuk json untuk datatables
     public function list(Request $request)
     {
        $query = LevelModel::select('level_id', 'level_kode', 'level_nama');
    
        if ($request->has('level_kode') && $request->level_kode != '') {
            $query->where('level_kode', $request->level_kode);
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn  = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
     }
 
     // Menampilkan halaman form tambah level
     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Level',
             'list'  => ['Home', 'Level', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah level baru'
         ];
 
         //$level = LevelModel::all(); // ambil data level untuk ditampilkan di form
         $activeMenu = 'level';       // set menu yang sedang aktif
 
         return view('level.create', [
             'breadcrumb' => $breadcrumb, 
             'page' => $page, 
             //'level' => $level, 
             'activeMenu' => $activeMenu
         ]);
     }
 
     public function store(Request $request)
     {
         // Validasi input
         $request->validate([
             'level_kode' => 'required|string|max:10|unique:m_level,level_kode', // level_kode harus diisi, string, maksimal 10 karakter, dan unik di tabel m_level kolom level_kode
             'level_nama' => 'required|string|max:100'  // nama harus diisi, berupa string, dan maksimal 100 karakter
         ]);
 
         // Menyimpan data level baru
         LevelModel::create($request->only(['level_kode', 'level_nama']));
 
         // Redirect ke halaman level dengan pesan sukses
         return redirect('/level')->with('success', 'Data level berhasil disimpan');
     }
 
     // Menampilkan detail level
     public function show(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'page', 'activeMenu', 'level'));
    }

    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100'
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update($request->only(['level_kode', 'level_nama']));

        return redirect('/level')->with('success', 'Data level berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            $level->delete();
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terkait dengan data lain.');
        }
    }

    // ========================= AJAX SECTION =========================

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            LevelModel::create($request->only(['level_kode', 'level_nama']));
            return response()->json([
                'status'  => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', compact('level'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update($request->only(['level_kode', 'level_nama']));
                return response()->json([
                    'status'  => true,
                    'message' => 'Data level berhasil diperbarui'
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
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', compact('level'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data level berhasil dihapus'
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
 
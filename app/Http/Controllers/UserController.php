<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// class UserController extends Controller{
//     public function index() {
//         $jumlahPengguna = UserModel::where('level_id', 2)->count();
//         return view('user', ['jumlahPengguna' => $jumlahPengguna]);
//     }
// }
    
//     public function index(){

//         $user = UserModel::firstOrCreate(
//             [
//                 'username' => 'manager',
//                 'nama' => 'manager',
//             ],
//         );
//         return view('user',['data' => $user]);
//     }
// }

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::create([
            'username' => 'manager13',
            'nama' => 'Manager13',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager13';

        $user->save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        $user->wasChanged(['nama', 'username']); // true
    }
}

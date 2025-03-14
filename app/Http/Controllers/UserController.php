<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    public function index() {
        $jumlahPengguna = UserModel::where('level_id', 2)->count();
        return view('user', ['jumlahPengguna' => $jumlahPengguna]);
    }
    
    // public function index(){

    //     $user = UserModel::where('level_id',2)->get();

    //     return view('user',['data' => $user]);
    // }
}
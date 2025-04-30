<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; //implementasi class authenticatable

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; //mendefinisikan nama tabel yg digunakan oleh model ini
    protected $primaryKey = 'user_id'; //mendefinisikan nama primary key yg digunakan
    protected $fillable = ['username', 'nama', 'password', 'level_id'];

    protected $hidden = ['password']; // jangan di tampilkan saat select
    protected $casts = ['password' => 'hashed']; //casting password agar auto di hash
    //relasi ke tabel level
    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    //mendapatkan nama role
    public function getRoleName(): string{
        return $this->level->level_nama;
    }

    //cek apakah user memiliki role tertentu
    public function hasRole($role): bool{
        return $this->level->level_kode == $role;
    }

    //mendapatkan kode role
    public function getRole(){
        return $this->level->level_kode;
    }
}
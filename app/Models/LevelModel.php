<?php

namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
//  use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use App\Models\UserModel;

 class LevelModel extends Model{
 
     use HasFactory;
     protected $table = 'm_level'; //mendefinisikan nama tabel yg digunakan oleh model ini
     protected $primaryKey = 'level_id'; //mendefinisikan nama primary key yg digunakan
    //  public function user(): BelongsTo{
    //      return $this->belongsTo(User::class);
     // public function user(): BelongsTo{
     //     return $this->belongsTo(User::class);
     // }
     protected $fillable = ['level_kode', 'level_nama'];
 
     public function users()
     {
         return $this->hasMany(UserModel::class, 'level_id', 'level_id');
     }
 }

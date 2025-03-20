<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
 class LevelModel extends Model{
     protected $table = 'm_level'; //mendefinisikan nama tabel yg digunakan oleh model ini
     protected $primaryKey = 'level_id'; //mendefinisikan nama primary key yg digunakan
     public function user(): BelongsTo{
         return $this->belongsTo(User::class);
     }
 }
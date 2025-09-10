<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    use HasFactory;

    protected $table='walas';
    protected $fillable=['nig','nama_walas','password'];
    protected $guarded=['id'];
    protected $hidden=['password'];

    public function  nilais(){
        return $this->belongsTo(Kelas::class,'kelas_id');

    }

    public function walas(){
        return $this->hasOne(Nilai::class, 'walas_id');
    }
}

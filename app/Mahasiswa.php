<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table='mahasiswa';
    protected $guarded = [];
    protected $dates = ['tanggal_lahir'];
    public $incrementing = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function getEmailAttribute($value)
    {
       return optional($this->user)->email;
    }
    public function pesertas()
    {
        return $this->hasMany(TaPesertaSemhas::class);
    }
    // Tambahkan Kode yang diperlukan dibawah ini
    public function pesertaSemhas()
    {
        return $this->hasMany(TaPesertaSemhas::class);
    }
}

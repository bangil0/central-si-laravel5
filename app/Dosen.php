<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table="dosen";
    protected $guarded=[];
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

    public function publikasis()
    {
        return $this->belongsToMany(Publikasi::class, PublikasiDosen::class);
    }

    // Tambahkan Kode yang diperlukan mulai dari sini
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaPesertaSemhas extends Model
{
    protected $table = 'ta_peserta_semhas';
    protected $primaryKey='id';
    protected $guarded = [];


    // Tambahkan Kode yang diperlukan dibawah ini'

    public function mahasiswa()
    {
        return $this->hasOne(mahasiswa::class,'mahasiswa_id','id');
    }

        public function taSemhas()
        {
            return $this->belongsTo(TaSemhas::class );
        }

}

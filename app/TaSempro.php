<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaSempro extends Model
{
    protected $table = 'ta_sempro';
    protected $guarded = [];

    protected $fillable = [
    	'nilai_huruf'
    ];

    // Tambahkan Kode yang diperlukan dibawah ini
    public function semhas_deadline_at()
    {
    	return $this->hasMany(TaSempro::class);
    }


    public function semhass()
    {
    	return $this->hasMany(TaSemhas::class);	
    }
    
}

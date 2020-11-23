<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket_Wisata extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'ID_PAKET';

    protected $table = 'paket_wisata';
    
    protected $fillable = 
    [
        'ID_ARMADA',
        'NAMA_PAKET',
        'TIPE_PAKET',
        'HARGA_DASAR',
        'HARGA_JUAL',
        'FASILITAS_PAKET'
    ];
}

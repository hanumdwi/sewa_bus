<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'ID_GALERI';

    protected $table = 'galeri';
    
    protected $fillable = 
    [
        'FOTO_ARMADA',
        'DESKRIPSI_FOTO'
    ];
}

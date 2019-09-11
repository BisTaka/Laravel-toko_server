<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primarykey = 'id_produk';

    public function kategori()
    {
        return $this->belongsTo('App\KategoriBarang', 'id_kategori');
    }
}

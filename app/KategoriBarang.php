<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'kategori_barang';
    protected $primarykey = 'id_kategori';
    protected $fillable = ['nama_kategori'];
}

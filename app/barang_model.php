<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang_model extends Model
{
    protected $table="barang";
    protected $primaryKey="id";
    protected $fillable = [
      'nama_barang', 'stok', 'foto'
    ];
}

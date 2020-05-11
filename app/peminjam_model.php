<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjam_model extends Model
{
    protected $table="peminjam";
    protected $primaryKey="id";

    protected $fillable = [
        'nama_peminjam', 'alamat', 'telp'
    ];
}

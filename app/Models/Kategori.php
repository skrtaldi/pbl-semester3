<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['kode', 'nama_kategori'];
    protected $primaryKey = 'id'; // Jika primary key tidak bernama 'id', sesuaikan dengan nama yang benar
}

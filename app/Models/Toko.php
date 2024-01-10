<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Toko extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    use HasFactory;
    protected $table = 'toko';
    protected $fillable = ['kode', 'kategori_id', 'nama', 'jumlah', 'harga', 'supplier', 'minLimit', 'maxLimit'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanggalan extends Model
{
    use HasFactory;
    protected $table = 'tanggalan';
    protected $fillable = ['tanggal'];
}

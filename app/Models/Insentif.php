<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insentif extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pegawai_id',
        'nama',
        'jumlah_lembur',
        'jumlah_absen',
        'insentif',
    ];
}

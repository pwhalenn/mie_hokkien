<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservasi_id',
        'user_id',
        'name',
        'tanggal',
        'waktu',
        'meja',
        'jumlah_pax',
        'status',];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pesanan_id',
        'kuantitas',
        'name',
        'harga',
    ];

    protected $primaryKey = 'item_pesanan_id';
}

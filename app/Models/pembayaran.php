<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pesanan_id',
        'status',
        'transaksi_id',
        'gross_amount',
        'metode',
    ];

    protected $primaryKey = 'pembayaran_id';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }
}

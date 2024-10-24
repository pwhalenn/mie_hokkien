<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_harga',];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pesanan_id', 'pesanan_id');
    }
}

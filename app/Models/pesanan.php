<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pesanan_id',
        'user_id',
        'total_harga',];

    public function items()
    {
        return $this->hasMany(Item_Pesanan::class, 'pesanan_id');
    }

    public function updateTotalHarga()
    {
        $totalHarga = $this->item_pesanans->sum('harga');
        $this->total_harga = $totalHarga;
        $this->save();

        
    }

    public function item_pesanans()
    {
        return $this->hasMany(Item_Pesanan::class, 'pesanan_id');
    }

    protected static function booted()
    {   
        static::creating(function ($pesanan) {
            if (is_null($pesanan->total_harga)) {
                $pesanan->total_harga = 0;
            }
        });

        static::updated(function ($pesanan) {            
            if ($pesanan->isDirty('total_harga')) {
                $pembayaran = Pembayaran::where('pesanan_id', $pesanan->id)->first();
                if ($pembayaran) {
                    $pembayaran->gross_amount = $pesanan->total_harga;
                    $pembayaran->save();
                }
            }
        });
    }
}

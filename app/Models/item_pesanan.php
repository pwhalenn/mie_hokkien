<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_pesanan_id',
        'pesanan_id',
        'kuantitas',
        'name',
        'harga',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    protected static function booted()
    {            
        static::saving(function ($itemPesanan) {
            $menu = Menu::where('name', $itemPesanan->name)->first();
            if ($menu) {
                $itemPesanan->harga = $menu->total_harga * $itemPesanan->kuantitas;
            }
        });

        parent::boot();

        static::saved(function ($itemPesanan) {
            $originalPesananId = $itemPesanan->getOriginal('pesanan_id');

            if ($originalPesananId != $itemPesanan->pesanan_id) {
                $oldPesanan = Pesanan::find($originalPesananId);
                if ($oldPesanan) {
                    $oldPesanan->updateTotalHarga();
                }
                $newPesanan = Pesanan::find($itemPesanan->pesanan_id);
                if ($newPesanan) {
                    $newPesanan->updateTotalHarga();
                }
            } else {
                $pesanan = $itemPesanan->pesanan;
                if ($pesanan) {
                    $pesanan->updateTotalHarga();
                }
            }
        });

        static::deleted(function ($itemPesanan) {
            $pesanan = $itemPesanan->pesanan;
            if ($pesanan && $pesanan->itemPesanans()->count() === 0) {
                $pesanan->delete();
            }
        });
    }
}
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
            // Get the original pesanan_id before the update
            $originalPesananId = $itemPesanan->getOriginal('pesanan_id');

            // If the pesanan_id has changed, update both old and new pesanan
            if ($originalPesananId != $itemPesanan->pesanan_id) {
                $oldPesanan = Pesanan::find($originalPesananId);
                if ($oldPesanan) {
                    $oldPesanan->updateTotalHarga();  // Recalculate total for old pesanan
                }

                $newPesanan = Pesanan::find($itemPesanan->pesanan_id);
                if ($newPesanan) {
                    $newPesanan->updateTotalHarga();  // Recalculate total for new pesanan
                }
            } else {
                // If pesanan_id hasn't changed, just update the current pesanan
                $pesanan = $itemPesanan->pesanan;
                if ($pesanan) {
                    $pesanan->updateTotalHarga();
                }
            }
        });

        // Handle recalculating total_harga when item_pesanan is deleted
        static::deleted(function ($itemPesanan) {
            $pesanan = $itemPesanan->pesanan;
            if ($pesanan) {
                $pesanan->updateTotalHarga();
            }
        });
    }
}
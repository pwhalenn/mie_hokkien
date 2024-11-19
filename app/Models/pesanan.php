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
        $totalHarga = $this->item_pesanans->sum('harga');  // Sum the harga of all associated item_pesanans
        $this->total_harga = $totalHarga;  // Update the total_harga field
        $this->save();  // Save the changes
    }

    public function item_pesanans()
    {
        return $this->hasMany(Item_Pesanan::class, 'pesanan_id');  // Ensure the correct relationship
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'userID',
        'pesanananID',
        'status',
        'transaksiID',
        'gross_amount',
        'metode'];
}

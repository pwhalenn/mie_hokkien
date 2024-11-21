<?php

namespace App\Imports;

use App\Models\pembayaran;
use Maatwebsite\Excel\Concerns\ToModel;

class pembayaranImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $rowCount=0;
    public function model(array $row)
    {
        $this->rowCount++;
        if($this->rowCount>1 && isset($row[0])){
        return new pembayaran([
            'pembayaran_id' => $row[0],
            'user_id' => $row[1],
            'pesanan_id' => $row[2],
            'status' => $row[3],
            'transaksi_id' => $row[4],
            'gross_amount' => $row[5],
            'metode' => $row[6]
        ]);}
    }
}

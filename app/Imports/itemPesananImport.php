<?php

namespace App\Imports;

use App\Models\item_pesanan;
use Maatwebsite\Excel\Concerns\ToModel;

class itemPesananImport implements ToModel
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
        return new item_Pesanan([
            'item_pesanan_id' => $row[0],
            'pesanan_id' => $row[1],
            'kuantitas' => $row[2],
            'name' => $row[3],
            'harga' => $row[4]
        ]);}
    }
}

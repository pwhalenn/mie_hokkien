<?php

namespace App\Imports;

use App\Models\pesanan;
use Maatwebsite\Excel\Concerns\ToModel;

class pesananImport implements ToModel
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
        return new pesanan([
            'pesanan_id' => $row[0],
            'user_id' => $row[1],
            'total_harga' => $row[2]
        ]);}
    }
}

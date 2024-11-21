<?php

namespace App\Imports;

use App\Models\reservasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class reservasiImport implements ToModel
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
        return new reservasi([
            'reservasi_id' => $row[0],
            'user_id' => $row[1],
            'name' => $row[2],
            'tanggal' => $row[3],
            'waktu' => $row[4],
            'meja' => $row[5],
            'jumlah_pax' => $row[6],
            'status' => $row[7]
        ]);}
    }
}

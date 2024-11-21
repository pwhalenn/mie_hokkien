<?php

namespace App\Imports;

use App\Models\menu;
use Maatwebsite\Excel\Concerns\ToModel;

class menuImport implements ToModel
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
        return new menu([
            'menu_id' => $row[0],
            'name' => $row[1],
            'deskripsi' => $row[2],
            'total_harga' => $row[3]
        ]);}
    }
}

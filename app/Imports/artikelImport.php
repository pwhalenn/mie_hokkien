<?php

namespace App\Imports;

use App\Models\artikel;
use Maatwebsite\Excel\Concerns\ToModel;

class artikelImport implements ToModel
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
        return new artikel([
            'artikel_id' => $row[0],
            'judul' => $row[1],
            'artikel' => $row[2]
        ]);}
    }
}

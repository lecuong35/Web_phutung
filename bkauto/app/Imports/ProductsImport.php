<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
           'name'     => $row['name'],
           'price'    => $row['price'], 
           'describe'     => $row['describe'],
           'image'    => $row['image'],
           'type_id'     => $row['type_id']
        ]);
    }
}

<?php

    namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'imagen_producto' => $row['imagen_producto'],
            'nombre_producto' => $row['nombre_producto'],
            'descripcion_producto' => $row['descripcion_producto'],
            'precio_producto' => $row['precio_producto'],
            'impoconsumo_producto' => $row['impoconsumo_producto'],
            'company_id' => $row['company_id'],
        ]);
    }
}

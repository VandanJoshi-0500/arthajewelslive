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
        $requiredKeys = ['name', 'long_description', 'short_description', 'category', 'mainstone', 'collection', 'show_on_web', 'quantity_stock', 'quantity_memo', 'price', 'created_at', 'updated_at', 'showondibs', 'showonbluefly', 'showonetsy', 'showoncustom1', 'showoncustom2', 'showoncustom3', 'donotlist', 'ebay', 'amazon', 'artisan', 'socheec', 'image', 'thumbnail_url', 'metal_type', 'tag_price', 'special_price', 'inventory', 'status'];

        // Check if all required keys exist in the row
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $row)) {
                return null;
            }
        }
        return new Product([
            'name' => $row['name'],
            'sku' => $row['name'],
            'long_description' => $row['long_description'],
            'short_description' => $row['short_description'],
            'category' => $row['category'],
            'mainstone' => $row['mainstone'],
            'collection' => $row['collection'],
            'show_on_web' => $row['show_on_web'],
            'quantity_stock' => $row['quantity_stock'],
            'quantity_memo' => $row['quantity_memo'],
            'price' => $row['price'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'showondibs' => $row['showondibs'],
            'showonbluefly' => $row['showonbluefly'],
            'showonetsy' => $row['showonetsy'],
            'showoncustom1' => $row['showoncustom1'],
            'showoncustom2' => $row['showoncustom2'],
            'showoncustom3' => $row['showoncustom3'],
            'donotlist' => $row['donotlist'],
            'ebay' => $row['ebay'],
            'amazon' => $row['amazon'],
            'artisan' => $row['artisan'],
            'socheec' => $row['socheec'],
            'image' => $row['image'],
            'thumbnail_url' => $row['thumbnail_url'],
            'metal_type' => $row['metal_type'],
            'tag_price' => $row['tag_price'],
            'special_price' => $row['special_price'],
            'inventory' => $row['inventory'],
            'status' => $row['status'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    use OpeneCommerceFileTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bash = [];
        foreach($this->open_file("products.csv") as $csv){
            $bash[] = [
                'id' => $csv[0],
                'product_name' => $csv[1],
                'description' => $csv[2],
                'style' => $csv[3],
                'brand' => $csv[4],
                'created_at' => $csv[5],
                'updated_at' => $csv[6],
                'url' => $csv[7],
                'product_type' => $csv[8],
                'shipping_price' => $csv[9],
                'note' => $csv[10],
                'admin_id' => $csv[11],
            ];
            if(count($bash) >= 500){
                Product::insert($bash);
                $bash = [];
            }
        }
        # Insert remaining items in the bash
        if(count($bash)){
            Product::insert($bash);
        }
    }
}

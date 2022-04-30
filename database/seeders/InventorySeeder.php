<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
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
        foreach($this->open_file("inventory.csv") as $csv){
            $bash[] = [
                'id' => $csv[0],
                'product_id' => $csv[1],
                'quantity' => $csv[2],
                'color' => $csv[3],
                'size' => $csv[4],
                'weight' => $csv[5],
                'price_cents' => $csv[6],
                'sale_price_cents' => $csv[7],
                'cost_cents' => $csv[8],
                'sku' => $csv[9],
                'length' => $csv[10],
                'width' => $csv[11],
                'height' => $csv[12],
                'note' => $csv[13],
            ];
            if(count($bash) >= 500){
                Inventory::insert($bash);
                $bash = [];
            }
        }
        # Insert remaining items in the bash
        if(count($bash)){
            Inventory::insert($bash);
        }
    }
}

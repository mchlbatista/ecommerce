<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
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
        foreach($this->open_file("orders.csv") as $csv){
            $bash[] = [
                'id' => $csv[0],
                'product_id' => $csv[1],
                'inventory_id' => $csv[2],
                'street_address' => $csv[3],
                'apartment' => $csv[4],
                'city' => $csv[5],
                'state' => $csv[6],
                'country_code' => $csv[7],
                'zip' => $csv[8],
                'phone_number' => $csv[9],
                'email' => $csv[10],
                'name' => $csv[11],
                'order_status' => $csv[12],
                'payment_ref' => $csv[13],
                'transaction_id' => $csv[14],
                'payment_amt_cents' => $csv[15],
                'ship_charged_cents' => $csv[17] === 'NULL' ? 0 : $csv[16],
                'ship_cost_cents' => $csv[17] === 'NULL' ? 0 : $csv[17],
                'subtotal_cents' => $csv[18],
                'total_cents' => $csv[19],
                'shipper_name' => $csv[20],
                'payment_date' => $csv[21],
                'shipped_date' => $csv[22],
                'tracking_number' => $csv[23],
                'tax_total_cents' => $csv[24],
                'created_at' => $csv[25],
                'updated_at' => $csv[26],
            ];
            if(count($bash) >= 100){
                Order::insert($bash);
                $bash = [];
            }
        }
        # Insert remaining items in the bash
        if(count($bash)){
            Order::insert($bash);
        }
    }
}

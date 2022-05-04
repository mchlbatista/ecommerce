<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
        foreach($this->open_file("users.csv") as $csv){
            $bash[] = [
                'id' => $csv[0],
                'name' => $csv[1],
                'email' => $csv[2],
                'password' => $csv[3],
                'superadmin' => $csv[5] == "0" ? false : true,
                'shop_name' => $csv[6],
                'created_at' => $csv[8],
                'updated_at' => $csv[9],
                'card_brand' => $csv[10],
                'card_last_four' => $csv[11],
                'trial_ends_at' => $csv[12],
                'shop_domain' => $csv[13],
                'is_enable' => $csv[14] == "0" ? false : true,
                'billing_plan' => $csv[15],
                'trial_starts_at' => $csv[16],
            ];
            if(count($bash) >= 500){
                User::insert($bash);
                $bash = [];
            }
        }
        # Insert remaining items in the bash
        if(count($bash)){
            User::insert($bash);
        }
    }
}

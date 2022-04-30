<?php

namespace Tests;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Seed the DB with User, Products and Inventories
     *
     * @param int $product_count
     * @param int $inventories_count
     *
     * @return void
     */
    protected function create_user_products_inventories($product_count, $inventories_count)
    {
        User::factory()
        ->has(
            Product::factory()->count($product_count)->has(
                Inventory::factory()->count($inventories_count)
            )
        )
        ->create();
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Inventory;
use App\Models\User;
use Tests\TestCase;

class InventoryModelTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Can get Client Inventory.
     *
     * @return void
     */
    public function test_get_client_inventory()
    {
        # Given
        $product_count = 5;
        $inventories_count = 5;
        $expected_total_inventories = $product_count * $inventories_count;

        # When
        $this->create_user_products_inventories(
            $product_count, $inventories_count
        );

        $user = User::find(1);
        $inventories = Inventory::byUser($user->id)->get();

        # Assert
        $this->assertEquals($expected_total_inventories, $inventories->count());

    }
}

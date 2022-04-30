<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia as Assert;
use App\Http\Controllers\InventoryController;
use App\Models\Inventory;
use App\Models\User;
use Tests\TestCase;

class InventoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Can get Client Inventory.
     *
     * @return void
     */
    public function test_get_user_inventory()
    {
        # Given
        $product_count = 5;
        $inventories_count = 5;
        $expected_total_inventories = $product_count * $inventories_count;
        $pagination = InventoryController::PAGINATION;

        # When
        $this->create_user_products_inventories(
            $product_count, $inventories_count
        );

        $user = User::find(1);

        # Assert
        $this->actingAs($user)
        ->get(route('inventory'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Inventory')
            ->has('user',fn (Assert $page) => $page
                ->where('id', $user->id)
                ->etc()
            )
            # Numbers of items per page
            ->has(
                'inventory.data',
                $expected_total_inventories > $pagination ? $pagination : $expected_total_inventories)
            # Total of inventory entries for this user
            ->where('inventory.total', $expected_total_inventories)
        );
    }

    /**
     * Can get Client Inventory SKU.
     *
     * @return void
     */
    public function test_get_user_inventory_sku()
    {
        # Given
        $product_count = 5;
        $inventories_count = 5;
        $expected_total_inventories = 5;
        $pagination = InventoryController::PAGINATION;
        $sku = 'SKUABC';

        # When
        $this->create_user_products_inventories(
            $product_count, $inventories_count
        );

        Inventory::factory()->state([
            'product_id' => 1,
            'sku' => $sku
        ])->count($expected_total_inventories)
        ->create();

        $user = User::find(1);

        # Assert
        $this->actingAs($user)
        ->get(route('inventory.sku', $sku))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Inventory')
            ->has('user',fn (Assert $page) => $page
                ->where('id', $user->id)
                ->etc()
            )
            # Numbers of items per page
            ->has(
                'inventory.data',
                $expected_total_inventories > $pagination ? $pagination : $expected_total_inventories)
            # Total of inventory entries for this user
            ->where('inventory.total', $expected_total_inventories)
        );
    }

    /**
     * Can get Client Inventory Product ID.
     *
     * @return void
     */
    public function test_get_user_inventory_product_id()
    {
        # Given
        $product_count = 5;
        $inventories_count = 5;
        $expected_total_inventories = 5;
        $pagination = InventoryController::PAGINATION;

        # When
        $this->create_user_products_inventories(
            $product_count, $inventories_count
        );

        $user = User::find(1);

        # Assert
        $this->actingAs($user)
        ->get(route('inventory.product_id', rand(1, $product_count)))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Inventory')
            ->has('user',fn (Assert $page) => $page
                ->where('id', $user->id)
                ->etc()
            )
            # Numbers of items per page
            ->has(
                'inventory.data',
                $expected_total_inventories > $pagination ? $pagination : $expected_total_inventories)
            # Total of inventory entries for this user
            ->where('inventory.total', $expected_total_inventories)
        );
    }
}

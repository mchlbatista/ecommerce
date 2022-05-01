<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductsController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Can get User Products
     *
     * @return void
     */
    public function test_can_get_user_products()
    {
        # Given
        $product_count = 50;
        $pagination = ProductsController::PAGINATION;

        # When
        $this->create_user_products_inventories(
            $product_count, 0
        );

        $user = User::find(1);

        # Assert
        $this->actingAs($user)
        ->get(route('products'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Products/Products')
            # Numbers of items per page
            ->has(
                'products.data',
                $product_count > $pagination ? $pagination : $product_count)
            # Total of products entries for this user
            ->where('products.total', $product_count)
        );
    }

    /**
     * Can get User product
     *
     * @return void
     */
    public function test_can_get_user_product()
    {
        # Given
        $product_count = 5;

        # When
        $this->create_user_products_inventories(
            $product_count, 0
        );

        $user = User::find(1);
        $product = Product::find(rand(1, $product_count));

        # Assert
        $this->actingAs($user)
        ->get(route('products.product', $product->id))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Products/Product')
            ->has('product', fn (Assert $page) => $page
                ->where('id', $product->id)
                ->where('product_name', $product->product_name)
                ->where('description', $product->description)
                ->where('product_type', $product->product_type)
                ->where('shipping_price', $product->shipping_price)
                ->where('admin_id', strval($user->id))
                ->etc()
            )
        );
    }
}

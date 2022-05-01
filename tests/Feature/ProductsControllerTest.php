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

    /**
     * Can update User Product
     *
     * @return void
     */
    public function test_can_updated_user_product()
    {
        # Given
        $product_count = 5;

        # When
        $this->create_user_products_inventories(
            $product_count, 0
        );
        $product_field_update = [
            'product_name' => 'test product name',
            'style' => 'test product style',
            'brand' => 'test product brand',
            'product_type' => 'test product type',
            'description' => 'test product',
            'shipping_price' => '9999'
        ];

        $user = User::find(1);
        $product = Product::find(rand(1, $product_count));

        # Assert
        $this->actingAs($user)
        ->put(route('products.product', $product->id), $product_field_update)
        ->assertInertia(fn (Assert $page) => $page
            ->component('Products/Product')
            ->has('product', fn (Assert $page) => $page
                ->where('id', $product->id)
                ->where('product_name', $product_field_update['product_name'])
                ->where('description', $product_field_update['description'])
                ->where('product_type', $product_field_update['product_type'])
                ->where('shipping_price', $product_field_update['shipping_price'])
                ->where('admin_id', strval($user->id))
                ->etc()
            )
        );
    }

    /**
     * Fails to update with invalid input
     * (validation test)
     *
     * @dataProvider products_put_input_provider
     * @return void
     */
    public function test_fails_update_with_invalid_input($product_field_update)
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
        $resp = $this->actingAs($user)
        ->put(
            route(
                'products.product',
                $product->id
            ),
            $product_field_update
        );
        // If validation fails it will redirect HTTP302
        $resp->assertStatus(302);
        // Check that the product shipping_price never changed
        $result_product = Product::find($product->id);
        $this->assertEquals(
            $product->shipping_price,
            $result_product->shipping_price
        );
    }

    /**
     * Data Provider
     * Invalid PUT products/{id}
     *
     * @return array
     */
    public function products_put_input_provider()
    {
        return [
            [
                [
                    'product_name' => null,
                    'product_type' => 12345,
                    'description' => null
                ]
            ],
            [
                // Particular case with invalid shipping_price
                [
                    'product_name' => 'test product name',
                    'style' => 'test product style',
                    'brand' => 'test product brand',
                    'product_type' => 'test product type',
                    'description' => 'test product',
                    'shipping_price' => 'test invalid type'
                ]
            ]
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductsController extends Controller
{
    /**
     * Default pagination
     */
    public const PAGINATION = 10;

    /**
     * Display a list of current User Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $products = Product::withCount('inventories')
        ->whereAdminId($user_id)
        ->paginate(static::PAGINATION);

        return Inertia::render('Products/Products',[
            'products' => $products
        ]);
    }

    /**
     * Display a current User Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $product = Product::whereAdminId($user_id)
        ->whereId($id)
        ->first();

        if(!$product) {
            return redirect()
            ->back()
            ->with(
                'failure', "Product ID $id not found."
            );
        }

        return Inertia::render('Products/Product',[
            'product' => $product
        ]);
    }

    /**
     * Update resource
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $user_id = auth()->user()->id;
        // Be sure that the product
        // we are trying to update belongs to the current user
        $product = Product::whereAdminId($user_id)
        ->whereId($id)
        ->first();

        if($product){
            $product->update($request->post());
            return Inertia::render('Products/Product',[
                'product' => $product
            ]);
        }

        return redirect()->route('products');
    }
}

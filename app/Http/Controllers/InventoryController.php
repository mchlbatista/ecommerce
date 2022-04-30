<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    const PAGINATION = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->paginate(static::PAGINATION);

        return Inertia::render('Inventory',[
            'inventory' => $inventory,
            'user' => auth()->user()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quantityBelowThat($threshold)
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->where('quantity', '<', $threshold)
        ->paginate(static::PAGINATION);

        if(!$inventory->total()) {
            return redirect()
            ->back()
            ->with(
                'failure', "No Products with less than $threshold count."
            );
        }

        return Inertia::render('Inventory',[
            'inventory' => $inventory,
            'user' => auth()->user()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sku($id)
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->where('sku', '=', $id)
        ->paginate(static::PAGINATION);

        if(!$inventory->total()) {
            return redirect()
            ->back()
            ->with(
                'failure', "Product SKU $id not found."
            );
        }

        return Inertia::render('Inventory',[
            'inventory' => $inventory,
            'user' => auth()->user()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productId($id)
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->where('product_id', '=', $id)
        ->paginate(static::PAGINATION);

        if(!$inventory->total()) {
            return redirect()
            ->back()
            ->with(
                'failure', "Product ID $id not found."
            );
        }

        return Inertia::render('Inventory',[
            'inventory' => $inventory,
            'user' => auth()->user()
        ]);
    }
}

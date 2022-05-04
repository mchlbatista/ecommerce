<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Default pagination
     */
    public const PAGINATION = 10;

    /**
     * Default Details Object
     */
    protected const DEFAULT_OBJ = [
        'threshold' => "",
        'sku' => "",
        'product_id' => ""
    ];

    /**
     * Display a list of current User Inventory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->paginate(static::PAGINATION);

        return Inertia::render('Inventory/Inventory',[
            'inventory' => $inventory,
            'title' => 'Inventory',
            'details' => static::DEFAULT_OBJ
        ]);
    }

    /**
     * Display list of current User Inventory
     * with count lower than the given threshold.
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

        return Inertia::render('Inventory/Inventory',[
            'inventory' => $inventory,
            'title' => "Inventory | With less than \"$threshold\" qty",
            'details' => array_merge(static::DEFAULT_OBJ, [
                'threshold' => $threshold
            ])
        ]);
    }

    /**
     * Display list of current User Inventory
     * with given SKU.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sku($sku)
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->whereSku($sku)
        ->paginate(static::PAGINATION);

        if(!$inventory->total()) {
            return redirect()
            ->back()
            ->with(
                'failure', "Product SKU $sku not found."
            );
        }

        return Inertia::render('Inventory/Inventory',[
            'inventory' => $inventory,
            'title' => "Inventory | SKU \"$sku\"",
            'details' => array_merge(static::DEFAULT_OBJ, [
                'sku' => $sku
            ])
        ]);
    }

    /**
     * Display list of current User Inventory
     * with given Product ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productId($id)
    {
        $user_id = auth()->user()->id;
        $inventory = Inventory::byUser($user_id)
        ->whereProductId($id)
        ->paginate(static::PAGINATION);

        if(!$inventory->total()) {
            return redirect()
            ->back()
            ->with(
                'failure', "Product ID $id not found."
            );
        }


        return Inertia::render('Inventory/Inventory',[
            'inventory' => $inventory,
            'title' => "Inventory | Product ID \"$id\"",
            'details' => array_merge(static::DEFAULT_OBJ, [
                'product_id' => $id
            ])
        ]);
    }
}

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
            'title' => 'Inventory'
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
            'title' => "Inventory | With less than \"$threshold\" qty"
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
        ->where('sku', '=', $sku)
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
            'title' => "Inventory | SKU \"$sku\""
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
        ->where('product_id', '=', $id)
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
            'title' => "Inventory | Product ID \"$id\""
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'color',
        'size',
        'weight',
        'price_cents',
        'sale_price_cents',
        'cost_cents',
        'sku',
        'length',
        'width',
        'height',
        'note'
    ];

    /**
     * Disable timestamp
     */
    public $timestamps = false;

    /**
     * Product related with the current Inventory
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Orders related with this Product
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * User Inventory
     *
     * @param int $user_id
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function byUser(int $user_id)
    {
        return Inventory::with('product:id,product_name')->whereHas(
            'product.user', function($q) use ($user_id){
            $q->where('admin_id', '=', $user_id);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'admin_id',
        'product_name',
        'description',
        'style',
        'brand',
        'created_at',
        'updated_at',
        'url',
        'product_type',
        'shipping_price',
        'note',
    ];

    /**
     * User related with the current product
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    /**
     * Inventories related with the current product
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Orders related with this Product
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

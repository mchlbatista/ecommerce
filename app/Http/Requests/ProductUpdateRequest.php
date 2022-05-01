<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'string',
            'style' => 'string',
            'brand' => 'string',
            'product_type' => 'string',
            'description' => 'string',
            # The type of this field in the DB is Integer
            # with a max of 2147483647 if the DB type is MySQL
            'shipping_price' => 'integer|min:0|max:2147483647'
        ];
    }
}

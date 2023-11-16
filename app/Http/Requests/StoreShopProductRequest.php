<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'shop_brand_id' => 'nullable|exists:shop_brands,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|unique:shop_products,slug',
            'sku' => 'nullable|unique:shop_products,sku',
            'barcode' => 'nullable|unique:shop_products,barcode',
            'description' => 'nullable|max:255',
            'qty' => 'numeric|max:255',
            'security_stock' => 'numeric|max:255',
            'featured' => 'required|boolean',
            'is_visible' => 'required|boolean',
            'old_price' => 'nullable|decimal:2|max:10',
            'price' => 'nullable|decimal:2|max:10',
            'cost' => 'nullable|decimal:2|max:10',
            'type' => 'nullable|in:deliverable,downloadable',
            'backorder' => 'required|boolean',
            'requires_shipping' => 'required|boolean',
            'published_at' => 'nullable|date',
            'seo_title' => 'nullable|max:60',
            'seo_description' => 'nullable|max:160',
            'weight_value' => 'nullable|decimal:2|max:10',
            'weight_unit' => 'string|in:kg',
            'height_value' => 'decimal:2|max:10',
            'height_unit' => 'string|in:cm',
            'width_value' => 'nullable|decimal:2|max:10',
            'width_unit' => 'string|in:cm',
            'depth_value' => 'nullable|decimal:2|max:10',
            'depth_unit' => 'string|in:cm',
            'volume_value' => 'nullable|decimal:2|max:10',
            'volume_unit' => 'string|in:cm',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ];
    }
}

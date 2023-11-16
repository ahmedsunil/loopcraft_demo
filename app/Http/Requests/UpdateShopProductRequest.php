<?php

namespace App\Http\Requests;

use App\Models\Shop\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopProductRequest extends FormRequest
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
        /* @var Product $shop_product */
        $shop_product = $this->route('shop_product');

        return [
            'shop_brand_id' => 'nullable|exists:shop_brands,id,' . $shop_product->id,
            'name' => 'string|max:255',
            'slug' => 'nullable|unique:shop_products,slug,' . $shop_product->id,
            'sku' => 'nullable|unique:shop_products,sku,' . $shop_product->id,
            'barcode' => 'nullable|unique:shop_products,barcode,' . $shop_product->id,
            'description' => 'nullable|max:255',
            'qty' => 'numeric|max:255',
            'security_stock' => 'numeric|max:255',
            'featured' => 'boolean',
            'is_visible' => 'boolean',
            'old_price' => 'nullable|decimal:2|max:10',
            'price' => 'nullable|decimal:2|max:10',
            'cost' => 'nullable|decimal:2|max:10',
            'type' => 'nullable|in:deliverable,downloadable',
            'backorder' => 'boolean',
            'requires_shipping' => 'boolean',
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

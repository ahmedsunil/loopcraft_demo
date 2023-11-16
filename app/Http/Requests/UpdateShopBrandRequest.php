<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopBrandRequest extends FormRequest
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
        /* @var Brand $shop_brand */
        $shop_brand = $this->route('shop_brand');

        return  [
                'name' => 'string|max:255',
                'website' => 'nullable|max:255',
                'slug' => 'nullable|unique:shop_brands,slug,' . $shop_brand->id,
                'description' => 'nullable|max:255',
                'is_visible' => 'boolean',
                'seo_title' => 'nullable|max:60',
                'seo_description' => 'nullable|max:160',
                'position' => 'integer',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
        ];
    }
}

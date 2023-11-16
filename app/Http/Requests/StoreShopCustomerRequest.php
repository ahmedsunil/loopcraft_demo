<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopCustomerRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'email' => 'nullable|unique:shop_customers,email',
                'photo' => 'nullable|max:255',
                'gender' => 'required|in:male,female',
                'phone' => 'nullable|digits:7',
                'birthday' => 'nullable|date',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
                'deleted_at' => 'nullable|date'
        ];
    }
}

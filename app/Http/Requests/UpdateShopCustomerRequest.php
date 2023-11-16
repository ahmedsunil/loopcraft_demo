<?php

namespace App\Http\Requests;

use App\Models\Shop\Customer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopCustomerRequest extends FormRequest
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
        /* @var Customer $shop_customer */
        $shop_customer = $this->route('shop_customer');

        return [
                'name' => 'string|max:255',
                'email' => 'nullable|unique:shop_customers,email,' . $shop_customer->id,
                'photo' => 'nullable|max:255',
                'gender' => 'in:male,female',
                'phone' => 'nullable|digits:7',
                'birthday' => 'nullable|date',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
                'deleted_at' => 'nullable|date'
        ];
    }
}

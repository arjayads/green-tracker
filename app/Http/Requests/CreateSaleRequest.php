<?php

namespace app\Http\Requests;

class CreateSaleRequest extends Request
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
            'product_id' => 'required|min:1',
            'date_sold' => 'required',
            'order_number' => 'required|unique:sales,order_number|max:30',
            'customer.first_name' => 'required|max:255',
            'customer.last_name' => 'required|max:255',
            'customer.phone_number' => 'required|max:15'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Select product',
            'customer.first_name.max' => 'The customer first name may not be greater than :max characters.',
            'customer.last_name.max' => 'The customer last name may not be greater than :max characters.',
            'customer.phone_number.max' => 'The customer phone number may not be greater than :max characters.',
            'customer.first_name.required' => 'The customer first name is required.',
            'customer.last_name.required' => 'The customer last name is required.',
            'customer.phone_number.required' => 'The customer phone number is required.',
        ];

    }
}

<?php

namespace app\Http\Requests;

class CreateUserRequest extends Request
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
            'id_number'     => 'required|numeric',
            'email'         => 'required|email|unique:users',
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'sex'           => 'required',
            'birthday'      => 'required',
            'shift_id'      => 'required'
        ];
    }
}

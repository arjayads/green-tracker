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
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed|min:3',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'sex'           => 'required',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id'
        ];
    }
}

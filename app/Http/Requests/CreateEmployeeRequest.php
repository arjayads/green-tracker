<?php

namespace app\Http\Requests;

use app\Models\Employee;
use Illuminate\Support\Facades\Input;

class CreateEmployeeRequest extends Request
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
        $e = Employee::with('user')->find(Input::get('empId'));
        return [
            'id_number'     => 'required|numeric',
            'email'         => 'required|email|unique:users,email,'.$e->user->id,
            'first_name'    => 'required|max:255',
            'middle_name'   => 'max:255',
            'last_name'     => 'required|max:255',
            'sex'           => 'required|in:Male,Female',
            'birthday'      => 'required|date',
            'shift_id'      => 'required|numeric'
        ];
    }
}

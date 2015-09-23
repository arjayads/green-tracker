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
        $rules = [
            'id_number'     => 'required|numeric',
            'email'         => 'required|email|unique:users,email',
            'first_name'    => 'required|max:255',
            'middle_name'   => 'max:255',
            'last_name'     => 'required|max:255',
            'sex'           => 'required|in:Male,Female',
            'birthday'      => 'required|date',
            'shift_id'      => 'required|numeric',
            'group_id'      => 'required|numeric'
        ];

        // update mode
        $e = Employee::with('user')->find(Input::get('empId'));
        if ($e && $e->user) {
            $rules['email'] = $rules['email'].','.$e->user->id;
        }
        return $rules;
    }
}

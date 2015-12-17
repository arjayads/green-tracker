<?php

namespace app\Http\Requests;

class ApplyForLeaveRequest extends Request
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
            'purpose' => 'required|min:4',
            'no_of_days' => 'required|numeric|min:1',
            'leave_type_id' => 'required|numeric',
            'dates' => 'required|array|min:1',
        ];
    }
}

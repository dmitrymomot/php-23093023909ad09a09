<?php

namespace App\Http\Requests;

use DB;

use App\Customer;

use Illuminate\Validation\Rule;

class CustomerStoreRequest extends ExtendedFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|between:2,50',
            'last_name' => 'required|between:2,50',
            'phone_number' => 'required|phone_number|unique_phone_number:customers,phone_number',
        ];
    }
}

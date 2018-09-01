<?php

namespace App\Http\Requests;

use App\Booking;

use Illuminate\Validation\Rule;

class CityStoreRequest extends ExtendedFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state' => 'required|size:2',
            'city' => [
                'required',
                Rule::unique('cities')->where(function ($query) {
                    $query->where('state', $this->input('state'))->where('city', $this->input('city'));
                }),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'state.size' => 'Enter state in short format, for example, CA instead California',
        ];
    }
}

<?php

namespace App\Http\Requests;

class QuickBookingRequest extends ExtendedFormRequest
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
            'phone_number' => 'required|phone_number',
            'city_id' => 'required|exists:cities,id',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:h:i',
            'duration' => 'required|numeric|min:1|max:12',
        ];
    }
}

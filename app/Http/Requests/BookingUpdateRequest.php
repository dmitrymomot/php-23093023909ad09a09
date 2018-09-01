<?php

namespace App\Http\Requests;

use App\Booking;

class BookingUpdateRequest extends ExtendedFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'cleaner_id' => 'required|exists:cleaners,id',
            'city' => 'required|exists:cities,id',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:h:i',
            'duration' => 'required|numeric|min:1|max:12',
        ];
    }
}

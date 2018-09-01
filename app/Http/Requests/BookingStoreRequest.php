<?php

namespace App\Http\Requests;

use App\Booking;

use Carbon\Carbon;

use Illuminate\Database\Query\Builder;

use Illuminate\Validation\Rule;

class BookingStoreRequest extends ExtendedFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|numeric|min:1|max:12',
            'city' => 'required|exists:cities,id',
            'customer_id' => 'required|exists:customers,id|is_customer_available',
            'cleaner_id' => 'required|exists:cleaners,id|is_customer_available',
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
            'customer_id.exists' => 'This customer already has an order in requested time',
        ];
    }
}

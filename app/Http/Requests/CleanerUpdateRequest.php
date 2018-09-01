<?php

namespace App\Http\Requests;

use App\Cleaner;

class CleanerUpdateRequest extends ExtendedFormRequest
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
            'quality_score' => 'required|numeric|between:0,5',
            'cities' => 'array',
        ];
    }
}

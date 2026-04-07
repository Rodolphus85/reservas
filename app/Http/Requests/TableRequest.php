<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location' => 'required',
            'number' => [
                'required',
                Rule::unique('tables')
                    ->where(function ($query) {
                        return $query->where('location_id', $this->location);
                    })
                    ->ignore($this->id)
            ],
            'guest_count' => 'required',
        ];
    }
}

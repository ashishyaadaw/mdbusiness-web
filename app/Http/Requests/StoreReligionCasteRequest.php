<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReligionCasteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'religion_id' => 'required|exists:religions,id',
            'name' => 'required|string|min:3|max:255',
        ];
    }
}

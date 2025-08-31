<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'required|string',
            'description' => 'required|string',
            'location'    => 'nullable|string',
        ];
    }
}

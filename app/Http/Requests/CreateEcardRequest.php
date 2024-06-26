<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEcardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'email:filter',
            'occupation' => 'required|max:30',
            'phone' => 'required|numeric',
            'location' => 'required',
            'website' => 'required',
            'ecard-logo' => 'required|image|mimes:jpeg,png,jpg|dimensions:width=150,height=150',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     */
    // public function messages(): array
    // {
    //     return [
    //         'ecard-logo.dimensions' => 'E Card logo should have 150px width & hight.',
    //     ];
    // }
}

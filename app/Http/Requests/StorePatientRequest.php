<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|min:8|confirmed', 
            'dob' => 'required|date|before:today', 
            'gender' => 'required|string|in:male,female', 
            'phone' => 'required|string|max:17', 
            'address' => 'required|string|max:255', 
            'emergency_contact_name' => 'required|string|max:255', 
            'emergency_contact_phone' => 'required|string|max:17',
        ];
    }
}

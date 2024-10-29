<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreproviderRequest extends FormRequest
{
    // define valid specializations & services
    private const VALID_SPECIALIZATIONS = ['General Practitioner', 'Cardiologist', 'Dermatologist', 'Pediatrician', 'Neurologist'];
    private const VALID_SERVICES = ['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'];
    
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
            // only allows for valid specializations and services to be entered
            'specialization' => 'required|string|in:' . implode(',', self::VALID_SPECIALIZATIONS),
            // ensures that at least one service is selected
            'services' => 'required|array|min:1',
            'services.*' => 'string|in:' . implode(',', self::VALID_SERVICES),
            'license_number' => 'required|string|regex:/^[A-Z]{2}[0-9]{6}$/',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproviderRequest extends FormRequest
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
            // allows email to remain unchanged if it is the same as the current email
            'email' => 'required|email|unique:providers,email,' . $this->route('provider')->id,
            // 'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:17',
            'address' => 'required|string|max:255',
            // only allows for valid specializations and services to be entered
            'services' => 'required|string|in' . implode(',', self::VALID_SERVICES),
        ];
    }
}

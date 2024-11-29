<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
{
    // Define valid services
    // private const VALID_SERVICES = ['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'];

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
        // Get all valid service ids and convert into an array
        $validServiceIds = Service::pluck('id')->toArray();
        return [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            // allows email to remain unchanged if it is the same as the current email
            'email' => 'required|email|unique:providers,email,' . $this->route('provider')->id,
            // 'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:17',
            'address' => 'required|string|max:255',
            // only allows for valid services to be selected
            'services' => 'required|array|min:1',
            'services.*' => 'integer|in:' . implode(',', $validServiceIds),
            'status' => 'required|in:Active,Inactive',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            // require the date of new schedules to on/after today
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|in:07:00,13:00,15:00',
            'end_time' => 'required|in:13:00,15:00,20:00',
            'provider_id' => 'required|exists:providers,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // convert start and end time to timestamps
            $start_time = strtotime($this->input('start_time'));
            $end_time = strtotime($this->input('end_time'));

            if ($end_time - $start_time < 5 * 60 * 60) {
                $validator->errors()->add('end_time', 'The end time must be at least 5 hours after start time.');
            }
        });
    }
}

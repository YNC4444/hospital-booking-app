<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'schedule_id' => 'required|exists:schedules,id',
      'patient_id' => 'required|exists:patients,id',
      'start_time' => [
        'required',
        'date_format:H:i',
        'after_or_equal:07:00',
        function ($attribute, $value, $fail) {
          if (!$this->isCleanStartTime($value)) {
            $fail(`The $attribute must be a clean start time (e.g., 1:00, 1:15, 1:30, or 1:45).`);
          }
        },
      ],
      'end_time' => [
        'required',
        'date_format:H:i',
        'before_or_equal:20:00',
        function ($attribute, $value, $fail) {
          if (!$this->isValidDuration($this->input('start_time'), $value)) {
            $fail(`The $attribute between start time and end time must be 15, 30, or 60 minutes.`);
          }
        },
      ],
      'status' => 'required|in:available,booked',
    ];
  }

  protected function isCleanStartTime($time)
  {
    $minutes = date('i', strtotime($time));
    return in_array($minutes, ['00', '15', '30', '45']);
  }

  protected function isValidDuration($start_time, $end_time)
  {
    $start = strtotime($start_time);
    $end = strtotime($end_time);
    $duration = ($end - $start) / 60; // Convert to minutes
    return in_array($duration, [15, 30, 60]);
  }
}

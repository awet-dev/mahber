<?php

namespace App\Http\Requests\Attendance;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // todo check if the user taking the attendance is user its self or user with role attendance_admin
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attended' => 'required|boolean',
            'description' => 'nullable|max:255|min:10',
            'attended_at' => 'required|date',
        ];
    }

    protected function prepareForValidation(): void
    {
        $attended = $this->get('attended');

        $this->merge([
            'attended' => $attended === 'on',
        ]);
    }
}

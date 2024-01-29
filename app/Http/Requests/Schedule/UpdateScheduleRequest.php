<?php

namespace App\Http\Requests\Schedule;

use App\Constant\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class UpdateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // todo check if the user has right to do this action
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'time' => ['required', 'datetime'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'group' => Rule::in(Group::toArray()),
            'user_id' => ['required', Rule::exists('users', 'id')],
        ];
    }
}

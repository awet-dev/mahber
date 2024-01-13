<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Enum\RoleEnum;
use Illuminate\Validation\Rule;
use App\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * @property User $user
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = $this->user();

        return !is_null($user) && (
                RoleRepository::userHasRole($user, RoleEnum::ADMIN)
                || $user->is($this->user)
            );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        // todo on update email, send email verification
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique(User::class)->ignore($this->user->id)
            ],
            'roles' => [
                'required', 'array',
                Rule::in(RoleEnum::toArray())
            ],
        ];
    }
}

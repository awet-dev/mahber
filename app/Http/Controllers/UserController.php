<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Constant\Ability;
use App\Constant\UserAbility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize(Ability::VIEW_ANY, User::class);

        return view('user.index', [
            'users' => User::all()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize(Ability::CREATE, User::class);

        $user = User::create($request->validated());

        // todo instead send invitation email with reset link and invitation info
        $status = Password::sendResetLink($request->only('email'));
        $redirect = to_route('users.edit', ['user' => $user->id]);

        return $status === Password::RESET_LINK_SENT
            ? $redirect->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize(Ability::CREATE, User::class);

        return view('user.create');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->authorize(Ability::VIEW, $user);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize(Ability::UPDATE, $user);

        $user->update($request->validated());

        return back()->with('message', 'User has been updated successfully');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize(Ability::DELETE, $user);

        // todo add soft delete to user modal
        if ($user->delete()) {
            return to_route('users.index')
                ->with('message', 'Successfully deleted user with email ' . $user->email);
        }

        return back()->with('message', 'Fail to delete user');
    }

    /**
     * @throws AuthorizationException
     */
    public function requestEmailVerification(User $user): RedirectResponse
    {
        $this->authorize(UserAbility::REQUEST_VERIFICATION, $user);

        // todo add verification_requested_at and verification_requested_count to show in the request verification btn in blade
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return back()->with('status', 'verification-link-sent');
        } else {
            return back()->with('status', 'email already verified');
        }
    }
}

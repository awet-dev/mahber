<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Constant\Ability;
use App\Models\Attendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize(Ability::VIEW_ANY, Attendance::class);

        /** @var User $user */
        $user = auth()->user();

        return view('attendance.index', [
            'attendances' => $user->attendances
                ->sortByDesc('created_at')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(StoreAttendanceRequest $request): RedirectResponse
    {
        $this->authorize(Ability::CREATE, Attendance::class);

        $validated = $request->validated();
        $attendance = new Attendance($validated);

        /** @var User $user */
        $user = auth()->user();
        $user->attendances()->save($attendance);

        return to_route('attendances.edit', [
            'attendance' => $attendance->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize(Ability::CREATE, Attendance::class);

        return view('attendance.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Attendance $attendance): View
    {
        $this->authorize(Ability::VIEW, $attendance);

        return view('attendance.edit', [
            'attendance' => $attendance
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance): RedirectResponse
    {
        $this->authorize(Ability::UPDATE, $attendance);

        $validated = $request->validated();
        $attendance->update($validated);

        return to_route('attendances.edit', [
            'attendance' => $attendance->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Attendance $attendance): RedirectResponse
    {
        $this->authorize(Ability::DELETE, $attendance);

        $attendance->delete();

        return to_route('attendances.index')
            ->with('success', 'Attendance deleted successfully');
    }
}

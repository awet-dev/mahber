<?php

namespace App\Http\Controllers;

use App\Constant\Group;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\Schedule\UpdateScheduleRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('schedule.index', [
            'schedules' => $user->schedules
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule): View
    {
        $user = $schedule->user;

        return view('schedule.detail', [
            'schedule' => $schedule,
            'users' => [$user->id => $user->name],
            'groups' => Group::toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validated();
        $updated = $schedule->update($validated);

        return to_route('schedules.edit', [
            'schedule' => $schedule->id,
        ])->with('updated', $updated);
    }
}

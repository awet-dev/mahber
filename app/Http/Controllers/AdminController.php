<?php

namespace App\Http\Controllers;

use App\Constant\Group;
use App\Http\Requests\Schedule\StoreScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use App\Traits\SelectInput;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    use SelectInput;

    /**
     * Display a listing of the resource.
     */
    public function indexSchedule(): View
    {
        return view('admin.schedule.index', [
            'schedules' => Schedule::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSchedule(): View
    {
        $collection = User::all(['id', 'name']);
        $users = $this->extractKeyValueArray($collection, 'id', 'name');

        return view('admin.schedule.create', [
            'users' => $users,
            'groups' => Group::toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSchedule(StoreScheduleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $schedule = Schedule::create($validated);

        return to_route('admin.schedules.edit', [
            'schedule' => $schedule->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSchedule(Schedule $schedule): View
    {
        $collection = User::all(['id', 'name']);
        $users = $this->extractKeyValueArray($collection, 'id', 'name');

        return view('admin.schedule.detail', [
            'schedule' => $schedule,
            'users' => $users,
            'groups' => Group::toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSchedule(UpdateScheduleRequest $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validated();
        $updated = $schedule->update($validated);

        return to_route('admin.schedules.edit', [
            'schedule' => $schedule->id,
        ])->with('updated', $updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySchedule(Schedule $schedule): RedirectResponse
    {
        $deleted = $schedule->delete();

        return to_route('admin.schedules.index')
            ->with('deleted', $deleted);
    }
}

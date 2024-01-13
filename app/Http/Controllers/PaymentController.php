<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user): View
    {
        return view('payment.index', [
            'payments' => $user->payments,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $payment = $user->payments()
            ->create($validated);

        return to_route('users.payments.edit', [
            'payment' => $payment->id,
            'user' => $user->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user): View
    {
        return view('payment.create', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Payment $payment): View
    {
        return view('payment.edit', [
            'payment' => $payment,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, User $user, Payment $payment): RedirectResponse
    {
        $validated = $request->validated();
        $updated = $payment->update($validated);

        return to_route('users.payments.edit', [
            'payment' => $payment->id,
            'user' => $user->id
        ])->with('updated', $updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Payment $payment): RedirectResponse
    {
        $deleted = $payment->delete();

        return to_route('payments.index', [
            'user' => $user->id
        ])->with('deleted', $deleted);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Booking;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Booking::class);



        $bookings = Booking::latest()->get();

        return view('app.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Booking::class);

        $tables = Table::pluck('table_number', 'id');

        return view('app.bookings.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Booking::class);

        $validated = $request->validated();
        
        $booking = Booking::create($validated);

        return redirect()
            ->route('bookings.edit', $booking)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Booking $booking): View
    {
        $this->authorize('view', $booking);

        return view('app.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Booking $booking): View
    {
        $this->authorize('update', $booking);

        $tables = Table::pluck('id', 'id');

        return view('app.bookings.edit', compact('booking', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BookingUpdateRequest $request,
        Booking $booking
    ): RedirectResponse {
        $this->authorize('update', $booking);

        $validated = $request->validated();

        $booking->update($validated);

        return redirect()
            ->route('bookings.edit', $booking)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Booking $booking
    ): RedirectResponse {
        $this->authorize('delete', $booking);

        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

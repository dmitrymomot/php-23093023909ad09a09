<?php

namespace App\Http\Controllers;

use DB;

use App\City;
use App\Booking;
use App\Cleaner;
use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\QuickBookingRequest;
use App\Http\Requests\BookingUpdateRequest;

use Illuminate\Http\Request;
use Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $booking = Booking::with('customer', 'cleaner', 'city')->paginate(25);

        return view('booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = (new Customer)->getList();
        $cleaners = (new Cleaner)->getList();
        $cities = (new City)->getList();

        return view('booking.create', compact('customers', 'cleaners', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BookingStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BookingStoreRequest $request)
    {
        Booking::create($request->validated());

        Session::flash('flash_message', 'Booking added!');

        return redirect('booking');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \App\Http\Requests\BookingUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, BookingUpdateRequest $request)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->update($request->validated())) {
            Session::flash('flash_message', 'Booking updated!');
        }

        return redirect('booking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if (Booking::destroy($id)) {
            Session::flash('flash_message', 'Booking deleted!');
        }

        return redirect('booking');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\QuickBookingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quickBooking(QuickBookingRequest $request)
    {
        // Booking::create($request->validated());

        Session::flash('flash_message', 'Booking added!');

        return back(200);
    }
}

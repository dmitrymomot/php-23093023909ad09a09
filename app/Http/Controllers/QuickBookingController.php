<?php

namespace App\Http\Controllers;

use Exception;

use App\City;
use App\Booking;
use App\Cleaner;
use App\Customer;
use App\Http\Requests\QuickBookingRequest;
use Illuminate\Http\Request;

class QuickBookingController extends Controller
{
    public function index()
    {
        $cities = (new City)->getList();

        return view('welcome', compact('cities'));
    }

    public function book(QuickBookingRequest $request)
    {
        $phoneNumber = '+'.preg_replace('/\D+/', '', $request->input('phone_number'));
        $customer = Customer::wherePhoneNumber($phoneNumber)->first();
        if ($customer) {
            if (!$customer->isAvailable($request->input('date'), $request->input('time'), $request->input('duration'))) {
                return back()->withInput($request->all())->with('error', 'You already have an active booking.');
            }
        } else {
            $customer = Customer::create($request->validated());
        }

        $cleaner = (new Cleaner)->getAvailable($request->input('date'), $request->input('time'), $request->input('duration'), $request->input('city_id'));
        if (!$cleaner) {
            return back()->withInput($request->all())->with('error', 'Could not found any available cleaner. Try change date or time and send request again');
        }

        $booking = (new Booking)->addNew($customer->id, $cleaner->id, $request->validated());

        return view('success_booking', compact('booking'));
    }
}

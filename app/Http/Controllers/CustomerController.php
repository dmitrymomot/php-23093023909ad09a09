<?php

namespace App\Http\Controllers;

use App\Booking;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customer = Customer::paginate(25);

        return view('customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CustomerStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CustomerStoreRequest $request)
    {
        Customer::create($request->validated());

        Session::flash('flash_message', 'Customer added!');

        return redirect('customer');
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
        $customer = Customer::findOrFail($id);

        return view('customer.show', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \App\Http\Requests\CustomerUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CustomerUpdateRequest $request)
    {
        $customer = Customer::findOrFail($id);
        if ($customer->update($request->validated())) {
            Session::flash('flash_message', 'Customer updated!');
        }

        return redirect('customer');
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
        if (Customer::destroy($id)) {
            (new Booking)->where('customer_id', $id)->delete();
            Session::flash('flash_message', 'Customer deleted!');
        }

        return redirect('customer');
    }
}

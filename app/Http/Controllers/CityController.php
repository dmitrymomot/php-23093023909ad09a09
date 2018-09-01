<?php

namespace App\Http\Controllers;

use App\City;
use App\Booking;
use App\Cleaner;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;

use Illuminate\Http\Request;
use Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $city = City::paginate(25);

        return view('city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CityStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CityStoreRequest $request)
    {
        City::create($request->validated());

        Session::flash('flash_message', 'City added!');

        return redirect('city');
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
        $city = City::findOrFail($id);

        return view('city.show', compact('city'));
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
        $city = City::findOrFail($id);

        return view('city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \App\Http\Requests\CityUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CityUpdateRequest $request)
    {
        $city = City::findOrFail($id);
        if ($city->update($request->validated())) {
            Session::flash('flash_message', 'City updated!');
        }

        return redirect('city');
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
        if (City::destroy($id)) {
            (new Booking)->where('city_id', $id)->delete();
            (new Cleaner)->detouchCity($id);
            Session::flash('flash_message', 'City deleted!');
        }

        return redirect('city');
    }
}

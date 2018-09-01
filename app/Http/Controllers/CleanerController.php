<?php

namespace App\Http\Controllers;

use App\City;
use App\Booking;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cleaner;
use App\Http\Requests\CleanerStoreRequest;
use App\Http\Requests\CleanerUpdateRequest;

use Illuminate\Http\Request;
use Session;

class CleanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cleaner = Cleaner::paginate(25);

        return view('cleaner.index', compact('cleaner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = (new City)->getList();
        return view('cleaner.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CleanerStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CleanerStoreRequest $request)
    {
        $cleaner = Cleaner::create($request->validated());
        if ($cleaner) {
            if (array_has($request->validated(), 'cities')) {
                $cleaner->cities()->sync(array_get($request->validated(), 'cities'));
            }
        }

        Session::flash('flash_message', 'Cleaner added!');
        return redirect('cleaner');
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
        $cleaner = Cleaner::findOrFail($id);
        return view('cleaner.show', compact('cleaner'));
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
        $cleaner = Cleaner::with('cities')->find($id);
        $cities = (new City)->getList();

        return view('cleaner.edit', compact('cleaner', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \App\Http\Requests\CleanerUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CleanerUpdateRequest $request)
    {
        $cleaner = Cleaner::findOrFail($id);
        if ($cleaner->update($request->validated())) {
            if (array_has($request->validated(), 'cities')) {
                $cleaner->cities()->sync(array_get($request->validated(), 'cities'));
            }

            Session::flash('flash_message', 'Cleaner updated!');
        }

        return redirect('cleaner');
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
        if (Cleaner::destroy($id)) {
            (new Booking)->where('cleaner_id', $id)->delete();
            (new Cleaner)->removeCityRelationsFor($id);
            Session::flash('flash_message', 'Cleaner deleted!');
        }

        return redirect('cleaner');
    }
}

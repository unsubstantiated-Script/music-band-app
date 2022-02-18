<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use Illuminate\Http\Request;
use Illuminate\Http\View;

class MusiciansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        switch ($request) {
            case $request->has('first_name'):
                //making the db Eloquent query case-insensitive
                $orderClause = 'UPPER(' . 'first_name' . ') ASC';
                $musicians = \App\Models\Musician::orderByRaw($orderClause)->paginate(10);
                //Making sure the order is retained through the pagination links
                $musicians->appends('first_name', 'asc')->links();
                break;
            case $request->has('last_name'):
                $orderClause = 'UPPER(' . 'last_name' . ') ASC';
                $musicians = \App\Models\Musician::orderByRaw($orderClause)->paginate(10);
                $musicians->appends('last_name', 'asc')->links();
                break;
            case $request->has('instrument'):
                $orderClause = 'UPPER(' . 'instrument' . ') ASC';
                $musicians = \App\Models\Musician::orderByRaw($orderClause)->paginate(10);
                $musicians->appends('instrument', 'asc')->links();
                break;
            default:
                $musicians = \App\Models\Musician::paginate(10);
                break;
        }

        return view('musicians.index', compact('musicians'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Musician::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        };

        $musician = new \App\Models\Musician();
        return view('musicians.create', ['musician' => $musician]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Musician::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        };

        \App\Models\Musician::create($this->validateData($request));
        return redirect()->route('musicians.index')->with('success', 'Rock n Rolla was added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $musician = \App\Models\Musician::findOrFail($id);
        return view('musicians.show', ['musician' => $musician]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->user()->cannot('update', Musician::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        };

        $musician = \App\Models\Musician::findOrFail($id);
        return view('musicians.edit', ['musician' => $musician]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->user()->cannot('update', Musician::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        };

        \App\Models\Musician::find($id)->update($this->validateData($request));
        return redirect()->route('musicians.index')->with('success', 'Rock n Rolla was updated successfully!');

    }

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy(Request $request, $id)
    {
        if ($request->user()->cannot('delete', Musician::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }
        ;

        $musician = \App\Models\Musician::find($id);
        $musician->delete();

        return redirect()->route('musicians.index')->with('success', 'Rock n Rolla was successfully deleted');

    }

    public function validateData($request)
    {
        // return $validatedData = $request->validate(
        //     [
        //         'first_name' => 'required',
        //         'last_name' => 'required',
        //         'instrument' => 'required',
        //         'website' => 'required',
        //     ]
        // );
        return $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'instrument' => 'required',
                'website' => 'required',
            ]
        );

    }
}

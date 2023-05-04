<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

/**
 * Class TrackController
 * @package App\Http\Controllers
 */
class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::paginate();

        return view('track.index', compact('tracks'))
            ->with('i', (request()->input('page', 1) - 1) * $tracks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $track = new Track();
        return view('track.create', compact('track'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Track::$rules);

        $track = Track::create($request->all());

        return redirect()->route('tracks.index')
            ->with('success', 'Track created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $track = Track::find($id);

        return view('track.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track = Track::find($id);

        return view('track.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Track $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        request()->validate(Track::$rules);

        $track->update($request->all());

        return redirect()->route('tracks.index')
            ->with('success', 'Track updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $track = Track::find($id)->delete();

        return redirect()->route('tracks.index')
            ->with('success', 'Track deleted successfully');
    }
}

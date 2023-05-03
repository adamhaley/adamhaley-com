<?php

namespace App\Http\Controllers;

use App\Models\Medium;
use Illuminate\Http\Request;

/**
 * Class MediumController
 * @package App\Http\Controllers
 */
class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Medium::paginate();

        return view('medium.index', compact('media'))
            ->with('i', (request()->input('page', 1) - 1) * $media->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medium = new Medium();
        return view('medium.create', compact('medium'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Medium::$rules);

        $medium = Medium::create($request->all());

        return redirect()->route('media.index')
            ->with('success', 'Medium created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medium = Medium::find($id);

        return view('medium.show', compact('medium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medium = Medium::find($id);

        return view('medium.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Medium $medium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medium $medium)
    {
        request()->validate(Medium::$rules);

        $medium->update($request->all());

        return redirect()->route('media.index')
            ->with('success', 'Medium updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $medium = Medium::find($id)->delete();

        return redirect()->route('media.index')
            ->with('success', 'Medium deleted successfully');
    }
}

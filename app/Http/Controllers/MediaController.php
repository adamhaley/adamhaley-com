<?php

namespace App\Http\Controllers;

use App\Models\media;
use Illuminate\Http\Request;

/**
 * Class mediaController
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = media::paginate();

        return view('media.index', compact('media'))
            ->with('i', (request()->input('page', 1) - 1) * $media->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = new media();
        return view('media.create', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(media::$rules);

        $media = media::create($request->all());

        return redirect()->route('media.index')
            ->with('success', 'media created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = media::find($id);

        return view('media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = media::find($id);

        return view('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  media $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, media $media)
    {
        request()->validate(media::$rules);

        $media->update($request->all());

        return redirect()->route('media.index')
            ->with('success', 'media updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $media = media::find($id)->delete();

        return redirect()->route('media.index')
            ->with('success', 'media deleted successfully');
    }
}

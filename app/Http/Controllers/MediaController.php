<?php

namespace App\Http\Controllers;

use App\Models\Media;
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
        $media = Media::paginate();

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
        $media = new Media();
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
        request()->validate(Media::$rules);

        $media = Media::create($request->all());

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
        $media = Media::find($id);

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
        $media = Media::find($id);

        return view('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Media $media
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
        $media = Media::find($id)->delete();

        return redirect()->route('media.index')
            ->with('success', 'media deleted successfully');
    }
}

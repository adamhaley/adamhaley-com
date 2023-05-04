<?php

namespace App\Http\Controllers;

use App\Models\MediaCategory;
use Illuminate\Http\Request;

/**
 * Class MediaCategoryController
 * @package App\Http\Controllers
 */
class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediaCategories = MediaCategory::paginate();

        return view('media-category.index', compact('mediaCategories'))
            ->with('i', (request()->input('page', 1) - 1) * $mediaCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mediaCategory = new MediaCategory();
        return view('media-category.create', compact('mediaCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(MediaCategory::$rules);

        $mediaCategory = MediaCategory::create($request->all());

        return redirect()->route('media-categories.index')
            ->with('success', 'MediaCategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mediaCategory = MediaCategory::find($id);

        return view('media-category.show', compact('mediaCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mediaCategory = MediaCategory::find($id);

        return view('media-category.edit', compact('mediaCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MediaCategory $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaCategory $mediaCategory)
    {
        request()->validate(MediaCategory::$rules);

        $mediaCategory->update($request->all());

        return redirect()->route('media-categories.index')
            ->with('success', 'MediaCategory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mediaCategory = MediaCategory::find($id)->delete();

        return redirect()->route('media-categories.index')
            ->with('success', 'MediaCategory deleted successfully');
    }
}

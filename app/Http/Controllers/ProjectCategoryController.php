<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

/**
 * Class ProjectCategoryController
 * @package App\Http\Controllers
 */
class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectCategories = ProjectCategory::paginate();

        return view('project-category.index', compact('projectCategories'))
            ->with('i', (request()->input('page', 1) - 1) * $projectCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectCategory = new ProjectCategory();
        return view('project-category.create', compact('projectCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProjectCategory::$rules);

        $projectCategory = ProjectCategory::create($request->all());

        return redirect()->route('project-categories.index')
            ->with('success', 'ProjectCategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectCategory = ProjectCategory::find($id);

        return view('project-category.show', compact('projectCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectCategory = ProjectCategory::find($id);

        return view('project-category.edit', compact('projectCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectCategory $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectCategory $projectCategory)
    {
        request()->validate(ProjectCategory::$rules);

        $projectCategory->update($request->all());

        return redirect()->route('project-categories.index')
            ->with('success', 'ProjectCategory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectCategory = ProjectCategory::find($id)->delete();

        return redirect()->route('project-categories.index')
            ->with('success', 'ProjectCategory deleted successfully');
    }
}

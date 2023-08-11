<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\news\CreateNewsCategoryRequest;
use App\Http\Requests\news\UpdateNewsCategoryRequest;

class NewsCategoryController extends Controller
{
    /**
     * Display a category of the resource.
     */
    public function index()
    {
        $this->authorize('news_category_list');

        $data['category'] = NewsCategory::orderBy('name')->get();

        return view('news_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('news_category_create');

        return view('news_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewsCategoryRequest $request)
    {
        $this->authorize('news_category_create');

        $fields= $request->validated();

        DB::transaction(function () use($fields) {
            NewsCategory::create($fields);
        });

        return to_route('news-category.index')->with('status','Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsCategory $news_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsCategory $news_category)
    {
        $this->authorize('news_category_update');

        $data['news_category']= $news_category;

        return view('news_category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsCategoryRequest $request, NewsCategory $news_category)
    {
        $this->authorize('news_category_update');

        $fields= $request->validated();

        DB::transaction(function () use($news_category,$fields) {
            $news_category->update($fields);
        });

        return to_route('news-category.index')->with('status','News Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsCategory $news_category)
    {
        $this->authorize('news_category_delete');

        DB::transaction(function () use($news_category) {
            $news_category->delete();
        });

        return to_route('news-category.index')->with('status','News Category Deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\news\CreateNewsRequest;
use App\Http\Requests\news\UpdateNewsRequest;

class NewsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('news_list');

        $data['newsList'] = News::latest()->get();

        return view('news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('news_create');

        $data['newsCat'] = NewsCategory::where('status', '1')->orderBy('name')->get();

        return view('news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewsRequest $request)
    {
        $this->authorize('news_create');

        $fields = $request->validated();

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $path = $img->store('news', 'public');

            $fields['image'] = $path;
        }

        DB::transaction(function () use ($fields) {
            News::create($fields);
        });

        return to_route('news.index')->with('status', 'News Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $this->authorize('news_view');

        $data['newsCat'] = NewsCategory::where('status', '1')->orderBy('name')->get();
        $data['news'] = $news;

        return view('news.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $this->authorize('news_update');

        // $this->isOwner($news->user_id);
        $this->isOwnerOrAdmin($news->user_id);

        $data['newsCat'] = NewsCategory::where('status', '1')->orderBy('name')->get();
        $data['news'] = $news;

        return view('news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->authorize('news_update');

        $this->isOwner($news->user_id);

        $fields = $request->validated();
        $prevNewsImg = $news->image;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $path = $img->store('news', 'public');

            $fields['image'] = $path;

            //delete prev image
            $this->deleteImage($imgDisk = 'public', $imgPath = $prevNewsImg);
        }

        DB::transaction(function () use ($news, $fields) {
            $news->update($fields);
        });

        return to_route('news.index')->with('status', 'News Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->authorize('news_delete');

        $this->isOwner($news->user_id);
        
        $newsImg = $news->image;

        DB::transaction(function () use ($news, $newsImg) {
            $news->delete();

            //delete news img
            $this->deleteImage($imgDisk = 'public', $imgPath = $newsImg);
        });

        return to_route('news.index')->with('status', 'News Deleted');
    }
}

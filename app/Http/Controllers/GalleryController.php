<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\gallery\CreateGalleryRequest;
use App\Http\Requests\gallery\UpdateGalleryRequest;

class GalleryController extends Controller
{  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('gallery_list');
        
        Gallery::latest()->paginate('5');
        $data['galleries'] = Gallery::latest()->get();

        return view('gallery.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('gallery_create');

        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGalleryRequest $request)
    {
        $this->authorize('gallery_create');
        
        $fields = $request->validated();

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $path = $img->store('gallery', 'public');

            $fields['image'] = $path;
        }

        DB::transaction(function () use ($fields) {
            Gallery::create($fields);
        });

        return to_route('gallery.index')->with('status', 'Gallery Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $this->authorize('gallery_update');

        $data['gallery'] = $gallery;

        return view('gallery.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $this->authorize('gallery_update');

        $fields = $request->validated();
        $prevGalleryImg= $gallery->image;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $path = $img->store('gallery', 'public');

            //delete prev img
            $this->deleteImage($imgDisk = 'public', $imgPath = $prevGalleryImg);

            $fields['image'] = $path;
        }

        DB::transaction(function () use ($gallery, $fields) {
            $gallery->update($fields);
        });

        return to_route('gallery.index')->with('status', 'Gallery Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $this->authorize('gallery_delete');

        $galleryImg = $gallery->image;

        DB::transaction(function () use ($gallery, $galleryImg) {
            $gallery->delete();

            //delete img
            $this->deleteImage($imgDisk = 'public', $imgPath = $galleryImg);
        });

        return to_route('gallery.index')->with('status', 'Gallery Deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'type'     => 'required|in:profile,gallery,about',
        ]);

        foreach ($request->file('photos', []) as $file) {
            $path = $file->store('photos', 'public');
            Photo::create([
                'title'      => $request->title ?? $file->getClientOriginalName(),
                'path'       => $path,
                'type'       => $request->type,
                'sort_order' => $request->sort_order ?? 0,
                'is_active'  => true,
            ]);
        }

        return back()->with('success', 'Photo(s) uploaded!');
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'type'       => 'required|in:profile,gallery,about',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $photo->update($data);

        return back()->with('success', 'Photo updated!');
    }

    public function destroy(Photo $photo)
    {
        @unlink(storage_path('app/public/' . $photo->path));
        $photo->delete();
        return back()->with('success', 'Photo deleted.');
    }
}

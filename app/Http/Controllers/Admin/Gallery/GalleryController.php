<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{

    public function index()
    {
        return view('admin.gallery.create');
    }

    public function list()
    {
        $galleries = Gallery::paginate(10);

        return view('admin.gallery.list', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return self::index($request)->withErrors($validator->errors());
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('/storage/images/galleries/');
            $image->move($destinationPath, $image_name);
        }

        Gallery::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $image_name
        ]);

        return redirect()->route('admin.gallery.list')->with('success', 'gallery added successfully');
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        $image_name = $gallery->image;

        if (($request->hasFile('image'))) {
            $file_path = public_path('storage/images/galleries/') . $gallery->image;
            unlink($file_path);
            $image = $request->file('image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('storage/images/galleries');
            $image->move($destinationPath, $image_name);
        }

        Gallery::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $image_name,
        ]);

        return redirect()->route('admin.gallery.list')->with('success', 'gallery updated successfully');
    }

    public function delete($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return redirect()->route('admin.gallery.list')->with('success', 'gallery deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Artist\Artwork;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArtworkController extends Controller
{
    public function index()
    {
        return view('artist.artwork.create');
    }

    public function list()
    {
        $artworks = Artwork::where('user_id', Auth::id())->paginate(10);

        return view('artist.artwork.list', compact('artworks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'dimension' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return self::index($request)->withErrors($validator->errors());
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('/storage/images/artworks/');
            $image->move($destinationPath, $image_name);
        }

        Artwork::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'dimension' => $request->dimension,
            'image' => $image_name
        ]);

        return redirect()->route('artist.artwork.list')->with('success', 'artwork added successfully');
    }

    public function edit($id)
    {
        $artwork = Artwork::find($id);

        return view('artist.artwork.edit', compact('artwork'));
    }

    public function update(Request $request, $id)
    {
        $artwork = Artwork::find($id);

        $image_name = $artwork->image;

        if (($request->hasFile('image'))) {
            $file_path = public_path('storage/images/artworks/') . $artwork->image;
            unlink($file_path);
            $image = $request->file('image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('storage/images/artworks');
            $image->move($destinationPath, $image_name);
        }

        Artwork::where('id', $id)->update([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'dimension' => $request->dimension,
            'image' => $image_name,
            'status' => 0
        ]);

        return redirect()->route('artist.artwork.list')->with('success', 'artwork updated successfully');
    }

    public function delete($id)
    {
        $artwork = Artwork::find($id);
        $artwork->delete();

        return redirect()->route('artist.artwork.list')->with('success', 'artwork deleted successfully');
    }
}

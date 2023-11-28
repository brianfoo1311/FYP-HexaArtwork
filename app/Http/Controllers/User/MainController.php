<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home()
    {
        $galleries = Gallery::orderBy('id', 'desc')->take(12)->get();

        return view('FrontEnd.home', compact('galleries'));

    }

    public function about()
    {
        return view('FrontEnd.about');
    }

    public function artist()
    {
        $artists = User::where('role_id', User::ARTIST_ROLE_ID)
            ->whereNotNull('image')
            ->whereNotNull('about')
            ->get();

        return view('FrontEnd.artist', compact('artists'));
    }

    public function search(Request $request)
    {
        $query = User::where('role_id', User::ARTIST_ROLE_ID);

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $artists = $query->whereNotNull('image')
            ->whereNotNull('about')
            ->get();

        return view('FrontEnd.artist', compact('artists'));
    }


    public function gallery(Request $request)
    {
        // Get distinct locations from the Gallery table
        $locations = Gallery::distinct()->pluck('location');

        $query = Gallery::orderBy('id', 'desc');

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        $galleries = $query->get();

        return view('FrontEnd.gallery', compact('galleries', 'locations'));
    }

    public function artwork(Request $request)
    {
        $query = Artwork::where('status', 1);

        // Fetch artists for dropdown
        $artists = User::where('role_id', 2)->pluck('name', 'id');

        // Filter by artist
        if ($request->filled('artist')) {
            $query->where('user_id', $request->input('artist'));
        }

        // Filter by price range
        if ($request->filled('price')) {
            $priceRange = array_map('trim', explode('-', $request->input('price')));
            if ($priceRange[1] == '') {
                // Handle "Above 2000" case
                $query->where(DB::raw('CAST(price AS UNSIGNED)'), '>=', $priceRange[0]);

            } else {
                $query->whereBetween(DB::raw('CAST(price AS UNSIGNED)'), [$priceRange[0], $priceRange[1]]);
            }
        }

        // Paginate the results
        $artworks = $query->paginate(12);

        return view('FrontEnd.artwork', compact('artworks', 'artists'));
    }

    public function artworkDetail($id)
    {
        $artwork = Artwork::find($id);

        return view('FrontEnd.artwork-detail', compact('artwork'));
    }


    public function userProfile()
    {
        return view('FrontEnd.setting.update-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'address' => 'required',
            'phone' => 'required',
        ]);

        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        // You can add a success message if needed
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderProducts')->get();

        return view('FrontEnd.order.list', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        $products = OrderProduct::where('order_id', $id)->get();

        return view('FrontEnd.order.detail', compact('order', 'products'));
    }

}
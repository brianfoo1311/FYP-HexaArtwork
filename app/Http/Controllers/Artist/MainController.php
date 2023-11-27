<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function dashboard()
    {
        $artworks = Artwork::where('user_id', Auth::id())->count();

        $artistId = Auth::id();

        $artworkIds = Artwork::where('user_id', $artistId)->pluck('id')->toArray();

        $orders = OrderProduct::whereIn('order_product_id', $artworkIds)->count();

        return view('artist.dashboard', compact('artworks', 'orders'));
    }

    public function settingProfile()
    {
        return view('artist.setting.update-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'about' => 'required|string',
        ]);

        $user = Auth::user();

        // Update user information
        $user->name = $request->input('name');
        $user->about = $request->input('about');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('storage/images/artist/profile/');
            $image->move($destinationPath, $image_name);
            $user->image = $image_name;
        }

        $user->save();

        return redirect()->route('artist.dashboard')->with('success', 'Profile updated successfully.');
    }

    public function orderList()
    {
        $artistId = Auth::id();

        $artworkIds = Artwork::where('user_id', $artistId)->pluck('id')->toArray();

        $orderProducts = OrderProduct::whereIn('order_product_id', $artworkIds)->get();

        // Get the order status for each order product
        $orderStatus = [];
        foreach ($orderProducts as $orderProduct) {
            $order = Order::find($orderProduct->order_id);
            if ($order) {
                $orderStatus[] = [
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'total'=>$order->total
                ];
            }
        }

        return view('artist.order.list', compact('orderProducts','orderStatus'));
    }
}

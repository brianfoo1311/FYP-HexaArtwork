<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $users = User::whereIn('role_id', [2, 3])->count();
        $orders = Order::count();
        $artworks = Artwork::count();

        return view('admin.dashboard', compact('users', 'artworks', 'orders'));
    }

    public function artworkList()
    {
        $artworks = Artwork::paginate(10);

        return view('admin.artwork.list', compact('artworks'));
    }

    public function artworkUpdateStatus(Request $request)
    {
        $artwork = Artwork::where('id', $request->id)->first();
        if ($artwork) {
            $artwork->status = $request->status;
            $artwork->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Artwork not found'
            ]);
        }
    }

    public function orderList()
    {
        $orders = Order::paginate(10);

        return view('admin.order.list', compact('orders'));
    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order) {
            $order->status = $request->order_status;
            $order->save();
        }

        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function userList(Request $request)
    {
        $roleFilter = $request->input('role');

        // Use paginate() for pagination
        $users = ($roleFilter) ? User::where('role_id', $roleFilter)->paginate(10) : User::paginate(10);

        return view('admin.user.list', compact('users'));
    }

}
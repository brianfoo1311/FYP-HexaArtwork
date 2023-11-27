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
        $users = User::where('role_id', User::USER_ROLE_ID)->count();
        $artists = User::where('role_id', User::ARTIST_ROLE_ID)->count();
        $orders = Order::count();
        $artworks = Artwork::count();

        return view('admin.dashboard', compact('users', 'artists', 'artworks', 'orders'));
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

//        $orderProducts = [];
//        foreach ($orders as $order) {
//            $orderProduct = OrderProduct::find($order->id);
//            if ($orderProduct) {
//                $orderProducts[] = [
//                    'order_id' => $orderProduct->id,
//                    'product_title' => $orderProduct->product_title,
//                    'product_quantity' => $orderProduct->product_quantity
//                ];
//            }
//
//        }

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

}

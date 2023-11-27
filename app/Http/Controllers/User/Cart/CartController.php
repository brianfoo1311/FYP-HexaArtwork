<?php

namespace App\Http\Controllers\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\CardException;
use Stripe\Token;


class CartController extends Controller
{

    public function addToCart(Request $request, Artwork $artwork)
    {
        // Retrieve user ID from the authenticated user
        $userId = Auth::user()->id;

        // Check if the product is already in the cart for the same user
        $existingCartItem = Cart::where('user_id', $userId)
            ->where('artwork_id', $artwork->id)
            ->first();

        if ($existingCartItem) {
            return response()->json(['message' => 'Product is already in the cart']);
        }

        // Validate and store the artwork in the cart table
        $this->validate($request, [
            'quantity' => 'required|integer|min:1',
        ]);

        // Assuming you have a Cart model
        Cart::create([
            'user_id' => $userId,
            'artwork_id' => $artwork->id,
            'quantity' => $request->input('quantity'),
            'price' => $artwork->price,
        ]);

        return response()->json(['message' => 'Artwork added to cart successfully']);
    }

    public function showCart()
    {
        // Retrieve the authenticated user's ID
        $userId = auth()->id();

        // Fetch the cart details for the authenticated user
        $cartItems = Cart::where('user_id', $userId)->with('artwork')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // You can pass $cartItems to a view and display them there
        return view('FrontEnd.cart', ['cartItems' => $cartItems, 'subtotal' => $subtotal]);
    }

    public function updateCart(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'cartItemId' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the authenticated user's ID
        $userId = auth()->id();

        // Update the cart item
        Cart::where('id', $request->input('cartItemId'))
            ->where('user_id', $userId)
            ->update(['quantity' => $request->input('quantity')]);

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function removeCartItem(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'cartItemId' => 'required|exists:carts,id',
        ]);

        // Retrieve the authenticated user's ID
        $userId = auth()->id();

        // Remove the cart item
        Cart::where('id', $request->input('cartItemId'))
            ->where('user_id', $userId)
            ->delete();

        return response()->json(['message' => 'Cart item removed successfully']);
    }

    public function checkout()
    {
        // Retrieve the authenticated user's ID
        $userId = auth()->id();

        // Fetch the cart details for the authenticated user
        $cartItems = Cart::where('user_id', $userId)->with('artwork')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // You can pass $cartItems to a view and display them there
        return view('FrontEnd.checkout', ['cartItems' => $cartItems, 'subtotal' => $subtotal]);
    }

    public function placeOrder(Request $request)
    {
        $amount = $request->total;
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'card_number' => 'required|numeric|digits:16',
                'expiration_month' => 'required|numeric|digits:2',
                'expiration_year' => 'required|numeric|digits:2',
                'cvc' => ['required', 'numeric', 'digits:3'],
            ]);

            \Stripe\Stripe::setApiKey(config('app.stripe_secret_key'));

            // Make a token for payment processing
            $stripeToken = Token::create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->expiration_month,
                    'exp_year' => $request->expiration_year,
                    'cvc' => $request->cvc,
                ],
            ]);
            $tokenId = $stripeToken->id;

            // Make a new customer using Stripe
            $customer = Customer::create([
                'source' => $tokenId,
                'name' => $request->name
            ]);

            $currency_code = 'usd';
            Charge::create([
                'amount' => $amount * 100,
                'customer' => $customer->id,
                'currency' => $currency_code,
                'source' => $customer->default_source,
                'description' => 'Customer Order Payment.',
            ]);


            $user = Auth::user();

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $request->total,
                'status' => 0
            ]);

            $cartItems = Cart::where('user_id', $user->id)->with('artwork')->get();

            foreach ($cartItems as $cartItem) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'order_product_id' => $cartItem->artwork->id,
                    'product_title' => $cartItem->artwork->title,
                    'product_description' => $cartItem->artwork->description,
                    'product_price' => $cartItem->artwork->price,
                    'product_image' => $cartItem->artwork->image,
                    'product_quantity' => $cartItem->quantity,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            return redirect(route('home'))->with('success', 'Your order is booked successfully');
        } catch (CardException $e) {
            $error = $e->getError()->message;
            return back()->with('error', 'Payment failed. Please try again later. ' . $error);
        }
    }

}

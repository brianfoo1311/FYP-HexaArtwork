@extends('FrontEnd.master')

@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Shopping Cart</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="{{route('home')}}">Home</a> <span class="me-2 ms-2"><i
                                    class="fa fa-caret-right"></i></span>
                            Shopping Cart</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cart_page" class="cart pt-4 pb-4">
        <div class="container-xl">
            <div class="cart_3 row mt-3">
                <div class="col-md-8">
                    <div class="cart_3l">
                        <h6>ARTWORK</h6>
                    </div>

                    <!-- Loop through cart items -->
                    @foreach($cartItems as $cartItem)
                        <div class="cart_3l1 mt-3 row ms-0 me-0">
                            <div class="col-md-3 ps-0 col-3">
                                <div class="cart_3l1i">
                                    <a href="#">
                                        <img src="{{asset('storage/images/artworks/'.$cartItem->artwork->image)}}"
                                             alt="{{ $cartItem->artwork->title }}" class="w-100">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="cart_3l1i1">
                                    <h6 class="fw-bold"><a href="#">{{ $cartItem->artwork->title }}</a></h6>
                                    <h6 class="fw-normal font_12 mt-3">{{ $cartItem->artwork->description }}</h6>
                                    <h6 class="font_12 mt-3">Vendor</h6>
                                    <h5 class="col_pink mt-3">${{ $cartItem->price }} * {{$cartItem->quantity}} =
                                        ${{ $cartItem->price * $cartItem->quantity}}</h5>
                                    <h6 class="font_12 mt-3 mb-3">Quantity</h6>
                                </div>
                                <div class="cart_3l1i2">
                                    <input type="number" min="1" value="{{ $cartItem->quantity }}" class="form-control"
                                           placeholder="Qty" id="quantityInput_{{ $cartItem->id }}">
                                    <h6><a class="button_1" href="#" onclick="removeCartItem('{{ $cartItem->id }}')">REMOVE</a>
                                    </h6>
                                    <h6><a class="button update-cart-link" href="#"
                                           data-cart-item-id="{{ $cartItem->id }}">UPDATE CART</a></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End loop -->

                </div>
                <div class="col-md-4">
                    <div class="cart_3r">
                        <h6 class="head_1">SUBTOTAL</h6>
                        <h5 class="text-center col_pink mt-3">${{ number_format($subtotal, 2) }}</h5>
                        <hr>
                        <h6 class="text-center mt-3">
                            @if($cartItems && $cartItems->count() > 0)
                            <a class="button" href="{{route('checkout')}}">PROCEED TO CHECKOUT</a>
                            @else
                                <button class="button" disabled>Cart is Empty</button>
                            @endif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function updateCart(cartItemId, quantity) {
            // Make an AJAX request to update the cart
            fetch('{{ route('update.cart') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    cartItemId: cartItemId,
                    quantity: quantity,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show a success message or handle it as needed
                    window.location.reload(); // Reload the page after updating the cart
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the cart');
                });
        }

        // Add this event listener to handle the click event on the "UPDATE CART" link
        document.addEventListener('DOMContentLoaded', function () {
            const updateCartLinks = document.querySelectorAll('.update-cart-link');

            updateCartLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    const cartItemId = this.getAttribute('data-cart-item-id');
                    const quantityInput = document.getElementById(`quantityInput_${cartItemId}`);
                    const quantity = quantityInput.value;

                    updateCart(cartItemId, quantity);
                });
            });
        });

        function removeCartItem(cartItemId) {
            // Make an AJAX request to remove the cart item
            fetch('{{ route('remove.cart.item') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    cartItemId: cartItemId,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show a success message or handle it as needed
                    window.location.reload(); // Reload the page after removing the cart item
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the cart item');
                });
        }
    </script>
@endsection

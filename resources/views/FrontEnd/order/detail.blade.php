@extends('FrontEnd.master')

@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Order Detail</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="{{route('home')}}">Home</a> <span class="me-2 ms-2"><i
                                    class="fa fa-caret-right"></i></span>
                            Order Detail</h6>
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
                        <h6>Order Detail</h6>
                    </div>

                    <!-- Loop through cart items -->
                    @foreach($products as $product)
                        <div class="cart_3l1 mt-3 row ms-0 me-0">
                            <div class="col-md-3 ps-0 col-3">
                                <div class="cart_3l1i">
                                    <a href="#">
                                        <img src="{{asset('storage/images/artworks/'.$product->product_image)}}"
                                             alt="{{ $product->product_title }}" class="w-100">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="cart_3l1i1">
                                    <h6 class="fw-bold"><a href="#">Title: {{ $product->product_title }}</a></h6>
                                    <h6 class="fw-normal font_12 mt-3">
                                        Description: {{ $product->product_description }}</h6>
                                    <h5 class="col_pink mt-3">Price ${{ $product->product_price }}</h5>
                                    <h6 class="font_12 mt-3 mb-3">Quantity: {{$product->product_quantity}}</h6>
                                    <h6 class="font_12 mt-3 mb-3">
                                        Status: {{$order->status == 0 ? 'Pending' : ($order->status == 1 ? 'On th Way' : 'Delivered')}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End loop -->
                </div>
                <div class="col-md-4">
                    <div class="cart_3r">
                        <h6 class="head_1">Cart Summary</h6>
                        <h5 class="text-center col_pink mt-3">Total: ${{ number_format($order->total, 2) }}</h5>
                        <hr>
                        <h6 class="text-center mt-3">
                                <a class="button">Thanks for the Order</a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

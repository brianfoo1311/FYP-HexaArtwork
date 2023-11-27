@extends('FrontEnd.master')
@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Checkout</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="{{route('home')}}">Home</a> <span class="me-2 ms-2"><i
                                    class="fa fa-caret-right"></i></span>
                            Checkout</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="checkout">
        <div class="container-xl">
            <div class="checkout_1 row">
                <div class="col-md-8">
                    <div class="checkout_1l">
                        <h5>Confirm your details</h5>
                        <p>You can update your details from your profile</p>
                    </div>
                    <div class="checkout_1l1 row">
                        <div class="col-md-6 ps-0">
                            <h6 class="font_14 fw-bold">Name</h6>
                            <input class="form-control" type="text" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="col-md-6 ps-0">
                            <h6 class="font_14 fw-bold">Email</h6>
                            <input class="form-control" type="email" value="{{auth()->user()->email}}" readonly>
                        </div>
                    </div>
                    <div class="checkout_1l1 row">
                        <div class="col-md-6 ps-0">
                            <h6 class="font_14 fw-bold">Shipping Address</h6>
                            <input class="form-control" type="text" value="{{auth()->user()->address}}" readonly>
                        </div>
                        <div class="col-md-6 ps-0">
                            <h6 class="font_14 fw-bold">Phone Number <span>*</span></h6>
                            <input class="form-control" type="tel" value="{{auth()->user()->phone}}" readonly>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="checkout_1r">
                        @if(isset($error))
                            <div class="container w-50">
                                <div class="alert alert-danger">{{ $error }}</div>
                            </div>
                        @endif
                        <h5>CART TOTALS</h5>
                        <hr class="line">
                        <h6 class="fw-bold font_14">Sub Total <span class="pull-right">${{$subtotal}}</span></h6>
                        <hr>
                        <form action="{{ route('place.order') }}" method="post">
                            @csrf
                            <input type="hidden" name="total" value="{{$subtotal}}">
                            <h5>PAYMENTS</h5>
                            <hr class="line">

                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Person Name</p>
                                        <input class="form-control mb-3" type="text" name="name"
                                               id="name" placeholder="Name" required value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Card Number</p>
                                        <input class="form-control mb-3" type="text" name="card_number"
                                               value="{{old('card_number')}}"
                                               id="card-number" placeholder="1234 5678 4356 7890" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Expiry Month</p>
                                        <input class="form-control mb-3 expiry" type="number" name="expiration_month"
                                               placeholder="MM" required value="{{old('expiration_month')}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Expiry Year</p>
                                        <input class="form-control mb-3 expiry" type="number" name="expiration_year"
                                               placeholder="YY" required value="{{old('expiration_year')}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">CVV/CVC</p>
                                        <input class="form-control mb-3 pt-2" type="number" name="cvc"
                                               value="{{old('cvc')}}"
                                               id="cvv" placeholder="***" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="mt-3 button">PROCEED TO PAY</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Validate user name
            $('#name').on('input', function () {
                if ($(this).val().length < 3) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validate card number
            $('#card-number').on('input', function () {
                var cardNumber = $(this).val().replace(/[^0-9]/g, '');
                if (cardNumber.length !== 16) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validate expiry month
            $('.expiry').on('input', function () {
                if ($(this).val().length !== 2) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validate CVV
            $('#cvv').on('input', function () {
                if ($(this).val().length !== 3) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });

    </script>

@endsection

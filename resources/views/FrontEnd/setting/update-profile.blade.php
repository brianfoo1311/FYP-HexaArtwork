@extends('FrontEnd.master')
@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">User Profile</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="{{route('home')}}">Home</a> <span class="me-2 ms-2"><i
                                    class="fa fa-caret-right"></i></span>
                            User Profile</h6>
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
                        <h5>Make Your profile updated</h5>
                        <p>Please enter details in order to checkout more quickly</p>
                    </div>
                    <form action="{{route('update.profile')}}" method="POST">
                        @csrf
                        <div class="checkout_1l1 row">
                            <div class="col-md-6 ps-0">
                                <h6 class="font_14 fw-bold">Address <span>* (Same as shipping address)</span></h6>
                                <input class="form-control" type="text" name="address" required>
                            </div>
                            <div class="col-md-6 ps-0">
                                <h6 class="font_14 fw-bold">Phone Number <span>*</span></h6>
                                <input class="form-control" type="tel" name="phone" required>
                            </div>
                        </div>
                        <button type="submit" class="nav-link border-0" style="background-color: #a81c51; color: #fff;">
                            Update
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="checkout_1r">
                        <h5>User Info</h5>
                        <hr class="line">
                        <h6 class="fw-bold font_14">Name: <span class="pull-right">{{auth()->user()->name}}</span></h6>
                        <p class="fw-bold font_14">Email: <span class="pull-right">{{auth()->user()->email}}</span></p>
                        <p class="fw-bold font_14">Phone: <span class="pull-right">{{auth()->user()->phone}}</span></p>
                        <p class="fw-bold font_14">Address: <span class="pull-right">{{auth()->user()->address}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

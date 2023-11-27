@extends('FrontEnd.master')
@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Orders</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0">
                            <a href="{{route('home')}}">Home</a>
                            <span class="me-2 ms-2">
                                <i class="fa fa-caret-right"></i>
                            </span>
                            Orders
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="checkout">
        <div class="container-xl">
            <div class="checkout_1 row">
                <div class="col-12">
                    <div class="checkout_1r">
                        <h5>Total Orders</h5>
                        <hr class="line">
                        <table class="table mb-0">
                            <thead style="color: #a81c51">
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody style="color: white">
                            @forelse($orders as $key=>$order)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>
                                        {{$order->status == 0 ? 'Pending' : ($order->status == 1 ? 'On th Way' : 'Delivered')}}
                                    </td>
                                    <td>${{$order->total}}</td>
                                    <td>
                                        <a href="{{route('view.order.details', $order->id)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Record Yet</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


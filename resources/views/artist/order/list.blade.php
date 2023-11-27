@extends('layouts.master')
@section('body')
    <div class="page-heading">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Artwork List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>LOGO</th>
                                        <th>Title</th>
                                        <th>DESCRIPTION</th>
                                        <th>TOTAL</th>
                                        <th>QUANTITY</th>
                                        <th>STATUS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orderProducts as $key=>$orderProduct)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>
                                                <img
                                                    src="{{asset('storage/images/artworks/'.$orderProduct->product_image)}}"
                                                    alt="logo"
                                                    width="45px">
                                            </td>
                                            <td>{{$orderProduct->product_title}}</td>
                                            <td>{{$orderProduct->product_description}}</td>
                                            <td>${{$orderStatus[$key]['total']}}</td>
                                            <td>{{$orderProduct->product_quantity}}</td>
                                            <td>
                                                @php
                                                    $orderStatusText = ($orderStatus[$key]['status'] == 0) ? 'Pending' : (($orderStatus[$key]['status'] == 1) ? 'On the way' : 'Delivered');
                                                @endphp
                                                {{$orderStatusText}}
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
            </div>
        </section>
    </div>
@endsection

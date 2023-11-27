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
                                    <h4 class="card-title">Order List</h4>
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
                                        <th>User Name</th>
                                        <th>User Address</th>
                                        <th>Phone</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orders as $key=>$order)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->user->address}}</td>
                                            <td>{{$order->user->phone}}</td>
                                            <td>${{$order->total}}</td>
                                            <td style="width: 210px;">
                                                @if($order->status == 0)
                                                    <form action="{{route('admin.order.change.status', $order->id)}}"
                                                          method="post" id="orderStatus{{$order->id}}">
                                                        @csrf
                                                        <select name="order_status"
                                                                class="changeStatus form-control"
                                                                data-id="{{$order->id}}">
                                                            <option value="0" selected disabled>Pending</option>
                                                            <option value="1">On the Way</option>
                                                        </select>
                                                    </form>
                                                @elseif($order->status == 1)
                                                    <form action="{{route('admin.order.change.status', $order->id)}}"
                                                          method="post" id="orderStatus{{$order->id}}">
                                                        @csrf
                                                        <select name="order_status"
                                                                class="changeStatus form-control"
                                                                data-id="{{$order->id}}">
                                                            <option value="1" selected disabled>On The Way</option>
                                                            <option value="2">Delivered</option>
                                                        </select>
                                                    </form>
                                                @elseif($order->status == 2)
                                                    <option value="2" selected disabled>Delivered</option>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Record Yet</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-2" style="justify-content: center; display: flex">
                                    {{$orders->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $('document').ready(function () {
            $(document).on('change', '.artworkStatus', function () {
                let status = $(this).find(":selected").val();
                let artwork_id = $(this).find(':selected').attr('data-id');
                let url = "{{route('admin.artwork.update.status')}}";
                let data = {
                    '_token': "{{csrf_token()}}",
                    'id': artwork_id,
                    'status': status
                }

                $.post(url, data, function (response) {
                    if (response.status == 'success') {
                        location.reload();
                    } else {
                        toastr.error('error', response.message);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('change', '.changeStatus', function () {
                let id = $(this).data('id');
                $('#orderStatus' + id).submit();
            });
        });
    </script>

@endsection

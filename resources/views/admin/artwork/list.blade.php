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
                                        <th>PRICE</th>
                                        <th>DIMENSION</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($artworks as $key=>$artwork)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>
                                                <img src="{{asset('storage/images/artworks/'.$artwork->image)}}"
                                                     alt="logo"
                                                     width="45px">
                                            </td>
                                            <td>{{$artwork->title}}</td>
                                            <td>{{$artwork->description}}</td>
                                            <td>{{$artwork->price}}</td>
                                            <td>{{$artwork->dimension}}</td>
                                            <td>
                                                <select name="artwork_status" class="artworkStatus form-select">
                                                    <option value="0"
                                                            {{ $artwork->status == 0 ? 'selected' : '' }}
                                                            {{ $artwork->status == 1 ? 'disabled' : '' }}
                                                            data-id="{{ $artwork->id }}">
                                                        Pending
                                                    </option>

                                                    <option value="1"
                                                            {{ $artwork->status == 1 ? 'selected' : '' }}
                                                            data-id="{{ $artwork->id }}">
                                                        Approved
                                                    </option>
                                                </select>
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
                                    {{$artworks->links()}}
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
@endsection

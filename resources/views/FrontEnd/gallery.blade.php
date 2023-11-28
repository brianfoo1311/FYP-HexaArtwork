@extends('FrontEnd.master')
@section('body')
    <section id="port" class="p_4">
        <div class="container-xl">
            <div class="row port_1 text-center">
                <div class="col-md-12">
                    <h1 class="font_60">Gallery</h1>
                    <p>Find the nearest gallery around you.</p>
                    <span class="icon_line col_pink"><i class="fa fa-square-o"></i></span>
                </div>
            </div>
            <div class="row port_2 mt-4">
                <div class="col-md-12">
                    <form id="filterForm" action="{{ route('gallery') }}" method="GET">
                        <ul class="nav nav-tabs justify-content-center border-0 mb-0">
                            <div class="row">
                                <div class="col-12">
                                    <select name="location" class="form-select bg_gray col_light" required=""
                                            onchange="submitForm()">
                                        <option value="">All Locations</option>
                                        @foreach($locations as $location)
                                            <option
                                                value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="folio" class="p_4">
        <div class="container-fluid">
            <div class="row folio_1 mt-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="folio_1i row">
                            @forelse($galleries as $gallery)
                                <div class="col-md-3">
                                    <div class="folio_main clearfix">
                                        <div class="folio_1im position-relative clearfix">
                                            <div class="folio_1im1 clearfix">
                                                <a href="#">
                                                    <img
                                                        src="{{ asset('storage/images/galleries/' . $gallery->image) }}"
                                                        data-bs-target="#exampleModal{{ $gallery->id }}"
                                                        data-bs-toggle="modal"
                                                        class="w-100"
                                                        alt="{{ $gallery->name }}">
                                                </a>
                                            </div>
                                            <div
                                                class="folio_1im2 pt-5 position-absolute top-0 h-100 text-center w-100 clearfix">
                                                <ul class="mb-0">
                                                    <li class="d-inline-block fs-5 me-1">
                                                        <a data-bs-target="#exampleModal{{ $gallery->id }}"
                                                           data-bs-toggle="modal" href="#">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div
                                                class="folio_1im3  p-3 position-absolute bottom-0  text-center w-100 clearfix">
                                                <h6>
                                                    <a class="text-light"
                                                       data-bs-target="#exampleModal{{ $gallery->id }}"
                                                       data-bs-toggle="modal" href="#">{{ $gallery->name }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal{{ $gallery->id }}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel{{ $gallery->id }}"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-black"
                                                            id="exampleModalLabel{{ $gallery->id }}">{{ $gallery->name }}</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6 class="text-black">Location: {{ $gallery->location }}</h6>
                                                        <p class="text-black">
                                                            Description:{{ $gallery->description }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="text-center">
                                    <h2> No Record Found</h2>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function submitForm() {
            $('#filterForm').submit();
        }
    </script>
@endsection

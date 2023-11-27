@extends('FrontEnd.master')
@section('body')
    <section id="port" class="p_4">
        <div class="container-xl">
            <div class="row port_1 text-center">
                <div class="col-md-12">
                    <h1 class="font_60">Artist</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                    <span class="icon_line col_pink"><i class="fa fa-square-o"></i></span>
                </div>
            </div>
            <div class="row port_2 mt-4">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('artist.search') }}">
                        @csrf
                        <ul class="nav nav-tabs justify-content-center border-0 mb-0">
                            <li class="nav-item">
                                <input type="text" name="name" placeholder="Search artist..." class="nav-link"
                                       required>
                            </li>
                            <li class="nav-item">
                                <button type="submit" class="nav-link" style="background-color: #a81c51; color: #fff;">
                                    Search
                                </button>
                            </li>
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
                            @forelse($artists as $artist)
                                <div class="col-md-3 mb-4">
                                    <div class="folio_main clearfix">
                                        <div class="folio_1im position-relative clearfix">
                                            <div class="folio_1im1 clearfix">
                                                <a href="#">
                                                    <img
                                                        src="{{ asset('storage/images/artist/profile/' . $artist->image) }}"
                                                        data-bs-target="#exampleModal{{ $artist->id }}"
                                                        data-bs-toggle="modal"
                                                        class="w-100"
                                                        alt="{{ $artist->name }}">
                                                </a>
                                            </div>
                                            <div
                                                class="folio_1im2 pt-5 position-absolute top-0 h-100 text-center w-100 clearfix">
                                                <ul class="mb-0">
                                                    <li class="d-inline-block fs-5 me-1">
                                                        <a data-bs-target="#exampleModal{{ $artist->id }}"
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
                                                       data-bs-target="#exampleModal{{ $artist->id }}"
                                                       data-bs-toggle="modal" href="#">{{ $artist->name }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal{{ $artist->id }}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel{{ $artist->id }}"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-black"
                                                            id="exampleModalLabel{{ $artist->id }}">{{ $artist->name }}</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-black">
                                                            {{ $artist->about }}</p>
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

@extends('FrontEnd.master')
@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Artwork</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="#">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span>
                            Artwork</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product" class="p_4">
        <div class="container-xl">
            <div class="row product_1">
                <div class="col-md-9">
                    <div class="product_1l">
                        <p class="mb-0 mt-2">
                            Showing {{ $artworks->firstItem() }}–{{ $artworks->lastItem() }} of {{ $artworks->total() }}
                            results
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product_1r">
                        <div class="row">
                            <div class="col-6">
                                <form id="filterForm" action="{{ route('artwork') }}" method="GET">
                                    <select name="artist" class="form-select bg_gray col_light" required=""
                                            onchange="submitForm()">
                                        <option value="">All</option>
                                        @foreach($artists as $artistId => $artistName)
                                            <option
                                                value="{{ $artistId }}" {{ request('artist') == $artistId ? 'selected' : '' }}>
                                                {{ $artistName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-6">
                                <form id="priceFilterForm" action="{{ route('artwork') }}" method="GET">
                                    <select name="price" class="form-select bg_gray col_light" required="">
                                        <option value="">Price</option>
                                        <option value="100-500" {{ request('price') == '100-500' ? 'selected' : '' }}>
                                            100-500
                                        </option>
                                        <option value="500-2000" {{ request('price') == '500-2000' ? 'selected' : '' }}>
                                            500-2000
                                        </option>
                                        <option value="2000-" {{ request('price') == '2000-' ? 'selected' : '' }}>Above
                                            2000
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product_2 mt-4">
                @forelse($artworks as $artwork)
                    <div class="col-md-3">
                        <div class="prod_main p-1 bg-white clearfix mb-4">
                            <div class="product_2im clearfix position-relative">
                                <div class="product_2imi clearfix">
                                    <div class="grid clearfix">
                                        <figure class="effect-jazz mb-0">
                                            <a href="{{route('artwork.detail',$artwork->id)}}"><img
                                                    src="{{asset('storage/images/artworks/'.$artwork->image)}}"
                                                    class="w-100" alt="abc"></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="product_2im1 position-relative clearfix">
                                <div class="clearfix product_2im1i text-center pt-3 pb-4">
                                    <h5 class="font_14 text-uppercase">
                                        <a class="col_dark"
                                           href="{{route('artwork.detail',$artwork->id)}}">{{$artwork->title}}</a>
                                    </h5>
                                    <span class="font_12 col_yell">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star-o"></i>
		                            </span>
                                    <h6 class="col_dark mt-2 mb-0">${{$artwork->price}}</h6>
                                </div>
                                <div class="clearfix product_2im1i1 text-center position-absolute w-100">
                                    <h6 class="d-inline-block bg_pink p-2 ps-3 pe-3">${{$artwork->price}}</h6>
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
            <div class="pages">
                <div class="col-md-12">
                    {{$artworks->links()}}
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

    <script>
        function submitForm() {
            $('#priceFilterForm').submit();
        }
    </script>
@endsection

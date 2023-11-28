@extends('FrontEnd.master')
@section('body')
    <div class="main_2 clearfix">
        <section id="center" class="center_home">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2" class="" aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-md-block">
                            <h1 class="text-white font_60">Red Beauty Nature</h1>
                            <h4 class="text-white mt-3">Photography</h4>
                            <p class="text-white mt-4">The beauty of a woman is not in a facial mode but the true beauty
                                in a woman is reflected in her soul. It is the caring that she lovingly gives the
                                passion that she shows. The beauty of a woman grows with the passing years.</p>
                            <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                        class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">Back to overview</span></a>
                            </h6>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-md-block">
                            <h1 class="text-white font_60">Other Type Painting</h1>
                            <h4 class="text-white mt-3">Photography</h4>
                            <p class="text-white mt-4">The beauty of a woman is not in a facial mode but the true beauty
                                in a woman is reflected in her soul. It is the caring that she lovingly gives the
                                passion that she shows. The beauty of a woman grows with the passing years.</p>
                            <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                        class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">Back to overview</span></a>
                            </h6>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-md-block">
                            <h1 class="text-white font_60">Trending Art Picture</h1>
                            <h4 class="text-white mt-3">Photography</h4>
                            <p class="text-white mt-4">The beauty of a woman is not in a facial mode but the true beauty
                                in a woman is reflected in her soul. It is the caring that she lovingly gives the
                                passion that she shows. The beauty of a woman grows with the passing years.</p>
                            <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                        class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">Back to overview</span></a>
                            </h6>

                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    </div>

    <section id="port" class="p_4">
        <div class="container-xl">
            <div class="row port_1 text-center">
                <div class="col-md-12">
                    <h1 class="font_60">Gallery</h1>
                    <p>Find the nearest gallery around you.</p>
                    <span class="icon_line col_pink"><i class="fa fa-square-o"></i></span>
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
                                                            Description: {{ $gallery->description }}</p>
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

    <section id="bloh_h" class="p_4">
        <div class="container-fluid">
            <div class="row port_1 text-center mb-4">
                <div class="col-md-12">
                    <h1 class="font_60">BLOG</h1>
                    <p>Company, product, and people news</p>
                    <span class="icon_line col_pink"><i class="fa fa-square-o"></i></span>
                </div>
            </div>
            <div class="row bloh_h1">
                <div class="col-md-6 p-0">
                    <div class="bloh_h1l">
                        <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/14.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/15.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bloh_h1r text-center">
                        <h1 class="font_50">ACRYLIC</h1>
                        <p class="mt-3"><span class="fw-bold">Acrylic painting</span>, technique in which pigments are
                            mixed with hot, liquid wax. After all of the colours have been applied to the painting
                            surface, a heating element is passed over them until the individual brush or spatula marks
                            fuse into a uniform film.</p>
                        <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                    class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">VIEW GALLERY</span></a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row bloh_h1">
                <div class="col-md-6">
                    <div class="bloh_h1r text-center">
                        <h1 class="font_50">ENCAUSTIC</h1>
                        <p class="mt-3"><span class="fw-bold">Other painting</span>, technique in which pigments are
                            mixed with hot, liquid wax. After all of the colours have been applied to the painting
                            surface, a heating element is passed over them until the individual brush or spatula marks
                            fuse into a uniform film.</p>
                        <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                    class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">VIEW GALLERY</span></a>
                        </h6>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="bloh_h1l">
                        <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/16.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/17.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bloh_h1">
                <div class="col-md-6 p-0">
                    <div class="bloh_h1l">
                        <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/18.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/19.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bloh_h1r text-center">
                        <h1 class="font_50">OIL PAINTING</h1>
                        <p class="mt-3"><span class="fw-bold">Acrylic painting</span>, technique in which pigments are
                            mixed with hot, liquid wax. After all of the colours have been applied to the painting
                            surface, a heating element is passed over them until the individual brush or spatula marks
                            fuse into a uniform film.</p>
                        <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                    class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">VIEW GALLERY</span></a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row bloh_h1">
                <div class="col-md-6">
                    <div class="bloh_h1r text-center">
                        <h1 class="font_50">IMPASTO</h1>
                        <p class="mt-3"><span class="fw-bold">Other painting</span>, technique in which pigments are
                            mixed with hot, liquid wax. After all of the colours have been applied to the painting
                            surface, a heating element is passed over them until the individual brush or spatula marks
                            fuse into a uniform film.</p>
                        <h6 class="mt-4 mb-0"><a class="button" href="#"><i
                                    class="fa fa-bullhorn bg-white col_pink p-3"> </i> <span class="ps-3 pe-3">VIEW GALLERY</span></a>
                        </h6>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="bloh_h1l">
                        <div id="carouselExampleCaptions4" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/20.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/21.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions4" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions4" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="about_h" class="p_4 pt-0">
        <div class="container-xl">
            <div class="row port_1 text-center mb-4">
                <div class="col-md-12">
                    <h1 class="font_60">ABOUT US</h1>
                    <p>Hexa Artwork is for Art Collecting</p>
                    <span class="icon_line col_pink"><i class="fa fa-square-o"></i></span>
                </div>
            </div>
            <div class="about_h1 row">
                <div class="col-md-6">
                    <div class="about_h1l">
                        <div class="grid clearfix">
                            <figure class="effect-jazz mb-0">
                                <a href="#"><img src="img/29.jpg" class="w-100" alt="abc"></a>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_h1r">
                        <h1>A LITTLE INTRO</h1>
                        <p>As the leading marketplace for art by the world’s emerging and established artists, 
                            we’ve made it easy for new and experienced collectors to discover, buy, 
                            and sell art—and so much more. Everything you’ll ever need to collect art, you’ll find on Hexa Artwork.</p>
                        <h1 class="mt-4">MY EXHIBITIONS</h1>
                        <p>Explore the artists' statements, delving into the inspiration and creative processes that breathe life into each piece. 
                            Themes and concepts weave a narrative, while curatorial insights shed light on the selection process. 
                            Meet the featured artists, discover their journeys, and connect with the stories behind the brushstrokes. 
                            Engage with interactive elements and, if applicable, join us for events or virtual experiences. 
                            Each artwork is accompanied by evocative descriptions, offering a glimpse into the artist's world. 
                            Don't miss limited editions or exclusive pieces. We invite you to not just view but experience art. 
                            Dive in, explore, and perhaps, make one of these unique creations your own.</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
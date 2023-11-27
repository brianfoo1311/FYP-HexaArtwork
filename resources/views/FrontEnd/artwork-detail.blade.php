@extends('FrontEnd.master')
@section('body')
    <section id="center" class="center_o bg_gray pt-2 pb-2">
        <div class="container-xl">
            <div class="row center_o1">
                <div class="col-md-5">
                    <div class="center_o1l">
                        <h2 class="mb-0">Artwork Detail</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="center_o1r text-end">
                        <h6 class="mb-0"><a href="{{route('home')}}">Home</a> <span class="me-2 ms-2"><i class="fa fa-caret-right"></i></span>
                            Artwork Detail</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="detail" class="p_4">
        <div class="container-xl">
            <div class="row detail_1">
                <div class="col-md-5">
                    <div class="detail_1l">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('storage/images/artworks/'.$artwork->image)}}"
                                         class="d-block w-100" alt="abc">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail_1r">
                        <h2>{{$artwork->title}}</h2>
                        <h6 class="font_14 mt-3 col_pink ">
                          <span class="col_yell">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-sta-or"></i>
                          </span>
                            - 3 Customer Reviews</h6>
                        <h4 class="mt-3"><span class="me-2">${{$artwork->price}}</span></h4>
                        <p>{{$artwork->description}}.</p>
                        <input id="quantityInput"
                               type="number"
                               min="1"
                               value="1"
                               class="form-control mt-2 bg_dark"
                               placeholder="Qty"
                               style="width:80px; height:49px; margin-right:10px; float:left;">
                        <h6 class="mt-4 mb-0 text-uppercase">
                            <a class="button" href="#" onclick="addToCart('{{ route('add.to.cart', $artwork) }}')">
                                <i class="fa fa-shopping-cart bg-white col_pink p-3"> </i>
                                <span class="ps-3 pe-3">Add To Cart</span>
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row detail_2">
                <div class="col-md-12">
                    <ul class="nav nav-tabs mb-0">
                        <li class="nav-item d-inline-block me-3">
                            <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-md-block">DESCRIPTION</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row detail_3 mt-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="home_i row">
                            <div class="col-md-12">
                                <p>{{$artwork->description}}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function addToCart(route) {
            // Get the quantity from the input field
            var quantity = document.getElementById('quantityInput').value;

            // Make an AJAX request to the add to cart route
            fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({quantity: quantity}),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show a success message or handle it as needed

                    // Reload the page on success
                    if (data.message === 'Artwork added to cart successfully') {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding to cart');
                });
        }
    </script>
@endsection

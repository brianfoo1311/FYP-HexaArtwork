<section id="header">
    <nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
        <div class="container-xl">
            <a class="navbar-brand fs-2 p-0 fw-bold text-white" href="{{route('home')}}"><i
                    class="fa fa-pencil col_pink me-1 align-middle"></i> Hexa <span
                    class="col_pink span_1">Artwork</span> <br> <span class="font_12 span_2">DIGITAL ART</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-0 ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>

                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="{{route('about')}}">About </a>--}}
                    {{--                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('artist')}}">Artist</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('artwork')}}">Artwork</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('gallery')}}">Gallery</a>
                    </li>

                    @if(auth()->check() && auth()->user()->isUser())
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('cart.show')}}">Cart</a>
                        </li>
                    @endif

                    @if(auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </a>
                            <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('user.profile')}}"> Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('view.orders')}}"> Order</a></li>
                                <li>
                                    <a class="dropdown-item border-0" href="javascript:void(0)"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register.view')}}">Sign Up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</section>

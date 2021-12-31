<?php
    use App\Http\Controllers\HelperController;
    $categories = HelperController::category();
    $sub_categories = HelperController::sub_cat();
//    $d = HelperController::details();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/brand.ico') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('header_script')
    <title>@if($title) {{ $title }} @endif</title>
</head>
<body>
    <!--    Header section-->
    <header id="top-header" class="sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                @guest
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img id="brand-logo" src="{{ asset('assets/img/logo.png') }}" alt="">
                    </a>
                @endguest
                @auth
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img id="brand-logo" src="{{ asset('assets/img/logo.png') }}" alt="">
                </a>
                @endauth
                <form class="form-inline">
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" placeholder="Search here">
                    </div>
                    <button type="submit" class="btn search-btn mb-2">Search</button>
                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        @endguest
                        <li class="nav-item active">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        @auth
                            @if(Auth::user()->user_role == 2 )
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('my_order') }}">My Order</a>
                                </li>
                            @endif
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('message') }}">Message</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                                </div>
                            </li>
                            @if(Auth::user()->user_role == 1)
                                <?php
                                    $qty = 0 ;
                                    foreach ((array) session('cart') as $id => $details){
                                        $qty = $qty + $details['quantity'];
                                    }
                                ?>
                                <li class="nav-item active pl-2">
                                    <a class="nav-link" href="{{ route('cart') }}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true">
                                            ({{ $qty }})
                                        </i>
                                    </a>
                                </li>
                            @endif
                        @endauth
                        @guest
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-btn" href="{{ route('registration') }}">Join</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <div id="main-navbar">
            <ul class="list-inline">
                @foreach($categories as $category)
                <li class="list-inline-item">
                    <a class="social-icon text-xs-center" href="{{ url('/category/gig/'.$category->id) }}">
                        {{ $category->name }}
                    </a>
                    <ul id="drop-down">
                        @foreach($sub_categories as $sub_cat)
                            @if($sub_cat->cat_id == $category->id)
                            <li><a href="{{ url('/subcategory/gig/'.$sub_cat->id) }}">{{ $sub_cat->name }}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </header>
    <!--    End Header section-->
    @yield('content')

    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Quick Link</h5>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="">Terms & Conditions</a></li>
                        <li><a href="">Privacy & Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="">Help & Support</a></li>
                        <li><a href="">Trust & Safety</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>News Latter</h5>
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Email">
                        </div>
                        <button type="submit" class="btn newslatter-btn mb-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="copyright">
        <p>&copy;Sharif and Joynal</p>
    </section>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.0/socket.io.min.js"></script>
    @yield('footer_script')

    <script>
        socket.on('user_connected', function (data) {
            $('#status_'+data).html('<span class="fa fa-circle chat-online"></span> Online');
        });

        socket.on('user_disconnect', function (data) {
            $('#status_'+data).html('<span class="fa fa-circle chat-offline"></span> Offline');
        });
    </script>
</body>
</html>

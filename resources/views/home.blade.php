@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
    <!--    Slider section-->
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slider/slider-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4 class="slider-title">First slide label</h4>
                        <h6 class="slider-title">Nulla vitae elit libero, a pharetra augue mollis interdum.</h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider/slider-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4 class="slider-title">First slide label</h4>
                        <h6 class="slider-title">Nulla vitae elit libero, a pharetra augue mollis interdum.</h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider/slider-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4 class="slider-title">First slide label</h4>
                        <h6 class="slider-title">Nulla vitae elit libero, a pharetra augue mollis interdum.</h6>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--   End Slider section-->
    <!--    section-->
    <div class="popular-header-area">
        <div class="container">
            <h1 class="popular-service text-center">Popular professional services</h1>
        </div>
    </div>

    <div class="container my-4">
        <!--Carousel Wrapper-->
        <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

            <!--Controls-->
            <div class="controls-top text-right pb-3">
                <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-angle-left card-left"></i></a>
                <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-angle-right card-right"></i></a>
            </div>
            <!--/.Controls-->

            <!--Indicators-->
            <ol class="carousel-indicators">
                <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                <li data-target="#multi-item-example" data-slide-to="1"></li>

            </ol>
            <!--/.Indicators-->

            <!--Slides-->
            <div class="carousel-inner" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">

                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/.First slide-->
                <!--Second slide-->
                <div class="carousel-item">
                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="float:left">
                        <div class="card mb-2">
                            <img class="card-img-top"
                                 src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.Second slide-->
            </div>
            <!--/.Slides-->
        </div>
        <!--/.Carousel Wrapper-->
    </div>
    <section id="support">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>A whole world of freelance talent at your fingertips</h3>
                    <h5><i class="fa fa-clock-o"></i>The best for every budget</h5>
                    <p>Find high-quality services at every price point. No hourly rates, just project-based pricing.</p>
                    <h5><i class="fa fa-clock-o"></i>Quality work done quickly</h5>
                    <p>Find the right freelancer to begin working on your project within minutes.</p>
                    <h5><i class="fa fa-clock-o"></i>Protected payments, every time</h5>
                    <p>Always know what you'll pay upfront. Your payment isn't released until you approve the work.</p>
                    <h5><i class="fa fa-clock-o"></i>24/7 support</h5>
                    <p>Questions? Our round-the-clock support team is available to help anytime, anywhere.</p>
                </div>
                <div class="col-md-6">
                    <img class="support-img" src="assets/img/support.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="explore-marketplace">
        <div class="container">
            <h1 class="text-center">Explore the marketplace</h1>
        </div>
    </section>
    <section id="explore-marketplace-area">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 bg-white text-center">
                    <a href="">
                        <img class="icons8" src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/000000/external-design-design-thinking-flatart-icons-outline-flatarticons-6.png"/>
                        <h6>Graphics & Design</h6>
                    </a>
                </div>
                <div class="col-md-3 bg-white text-center">
                    <a href="">
                        <img class="icons8" src="https://img.icons8.com/dotty/80/000000/marketing.png"/>
                        <h6>Digital Marketing</h6>
                    </a>
                </div>
                <div class="col-md-3 bg-white text-center">
                    <a href="">
                        <img class="icons8" src="https://img.icons8.com/external-becris-lineal-becris/64/000000/external-writing-hobbies-becris-lineal-becris.png"/>
                        <h6>Writing & Translation</h6>
                    </a>
                </div>
                <div class="col-md-3 bg-white text-center">
                    <a href="">
                        <img class="icons8" src="https://img.icons8.com/windows/32/000000/video.png"/>
                        <h6>Video & Animation</h6>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
@endsection

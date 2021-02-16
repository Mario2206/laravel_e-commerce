@extends('layouts.layout-common')

@section('main')
    <div class="hero_area">

        @include('inc.header-client')


        <div class="wrapper w-50 flex-grow-1">
            <h1>Bienvenue sur le meilleur des sites E-commerce de la Terre</h1>
        </div>
        <section class="slider_section ">
            <div class="play_btn">
                <a href="">
                    <img src="images/play.png" alt="">
                </a>
            </div>
            <div class="number_box">
                <div>
                    <ol class="carousel-indicators indicator-2">
                        @for($i = 0; $i < count($categories); $i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? "active" : null}}">{{$i}}</li>
                        @endfor

                    </ol>
                </div>
            </div>
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i = 0; $i < count($categories); $i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? "active" : null}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for($i = 0; $i < count($categories); $i++)
                            <div class="carousel-item {{$i === 0 ? "active" : null}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-box">
                                            <h2>
                                                 {{ $categories[$i]->name }}
                                            </h2>
                                            <div class="btn-box">
                                                <a href="" class="btn-1">
                                                    Voir les produits
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 img-container">
                                        <div class="img-box">
                                            <img src="{{asset('storage' . "/" . $categories[$i]->img_path)}}" alt="image for {{ $categories[$i]->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>
            </div>
        </section>

    </div>
    @include('inc.footer')
@endsection

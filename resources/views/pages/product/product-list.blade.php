@extends('layouts.layout-client')

@section('content')
    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Featured Brands
                </h2>
            </div>
            <div class="brand_container layout_padding2">
                @foreach($products as $product) :
                    <div class="box">
                        <a href="">
                            <div class="img-box">
                                <img src="{{asset('storage/' . $product->img_path)}}" alt="{{$product->name}} image">
                            </div>
                            <div class="detail-box">
                                <h6 class="price">
                                    ${{$product->price}}
                                </h6>
                                <h6>
                                    {{$product->name}}
                                </h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <a href="" class="brand-btn">
                See More
            </a>
        </div>
    </section>

@endsection

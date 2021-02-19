@extends('layouts.layout-customer')

@section('content')
    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container justify-content-between">
                <h2>
                    {{$category->name}}
                </h2>
                <div class="d-flex flex-column align-items-center">
                    <h4>Trier</h4>
                    <div class="d-flex">
                        <a href="{{ route('product-list', ['categorySlug' => $category->slug]) . "?orderby=price&type=desc"  }}" class="btn btn-primary mx-2">+ au - cher</a>
                        <a href="{{ route('product-list', ['categorySlug' => $category->slug]) . "?orderby=price&type=asc"  }}" class="btn btn-primary mx-2">- au + cher</a>
                    </div>

                </div>
            </div>
            <div class="brand_container layout_padding2">
                @foreach($products as $product)
                    <div class="box">
                        <a href="{{ route('product-page', ['categorySlug' => $category->slug, "productId" => $product->id]) }}">
                            <div class="img-box">
                                <img src="{{asset('storage/' . $product->img_path)}}" alt="{{$product->name}} image">
                            </div>
                            <div class="detail-box">
                                <h6 class="price py-1 font-weight-bold">
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

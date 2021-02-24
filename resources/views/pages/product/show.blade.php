@extends('layouts.layout-customer')

@section('content')


    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    {{$product->name}}
                </h2>
            </div>
            <div class="brand_container layout_padding2">
                <img class="px-3" src="{{asset('storage/' . $product->img_path)}}" alt="{{$product->name}} image">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-around">
                <form action="{{ route('cart-store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="brand-btn m-0">
                        Acheter
                    </button>
                    <select name="quantity" id="">
                        @for($i = 1; $i <= ($product->stock >= 30 ? 30 : $product->stock); $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </form>
                <p class="m-0">
                    Stock: <span class="font-weight-bold">{{ $product->stock }}</span>
                </p>
            </div>

        </div>
    </section>
    <section class="brand_section layout_padding"">
        <h3 class="text-center">Quelques produits de la catégorie <br><br><strong>{{$category->name}}</strong></h3>
        <div class="container">
            <div class="brand_container layout_padding2">
                @foreach($annexProducts as $product)
                    <div class="box">
                        <a href="{{ route('category-page', ['categorySlug' => $category->slug, "productId" => $product->id]) }}">
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
        </div>

    </section>
@endsection

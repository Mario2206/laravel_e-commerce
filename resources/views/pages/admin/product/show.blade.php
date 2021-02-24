@extends('layouts.layout-admin')

@section('content')


    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    {{ $product->name }}
                </h2>
            </div>
            <div class="brand_container layout_padding2">
                <img class="px-3" src="{{asset('storage/' . $product->img_path)}}" alt="{{$product->name}} image">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-around">
                <p class="m-0">
                    Stock: <span class="font-weight-bold">{{ $product->stock }}</span>
                </p>
            </div>
        </div>
    </section>
    <section>
        <form action="{{ route("products.update", ["product" => $product->id]) }}" method="POST">
            @method("PUT")
            @csrf
        </form>
    </section>

@endsection

@extends('layouts.layout-admin')

@section('content')


    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container d-flex justify-content-between">
                <h2>
                    {{ $product->name }}
                </h2>
                <form action="{{ route("products.destroy", ["product" => $product->id]) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </div>
            <div class="brand_container layout_padding2">
                <img class="px-3" src="{{asset('storage/' . $product->img_path)}}" alt="{{$product->name}} image">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-around border p-5">
                <p class="m-0">
                    Stock: <span class="font-weight-bold">{{ $product->stock }}</span>
                </p>
                <p class="m-0">
                    Prix: <span class="font-weight-bold">{{ $product->price }}$</span>
                </p>
            </div>
        </div>
    </section>
    <section class="container">
        <h2>Editer le produit</h2>
        @include('inc.forms.product-form')
    </section>

@endsection

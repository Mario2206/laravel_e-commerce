@extends('layouts.layout-customer')

@section('content')

    <h1 class="text-center">Votre panier</h1>
    <section class="container brand_section">

        @foreach($products as $product)

            <article class="d-flex justify-content-between align-items-center py-3">
                <header class="col-3">
                    <h2>{{ $product["product"]->name }}</h2>
                    <img src="{{ asset('storage/' . $product["product"]->img_path) }}" alt="" class="w-100">
                </header>

                <form action="" method="POST">
                    <input type="number" value="{{ $product["quantity"] }}">
                    <button class="brand-btn">Editer</button>
                </form>
            </article>
        @endforeach
    </section>
@endsection

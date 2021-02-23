@extends('layouts.layout-customer')

@section('content')

    <h1 class="text-center">Votre panier</h1>
    <section class="container brand_section min-vh-100">

        @foreach($products as $product)

            <article class="d-flex justify-content-between align-items-center py-3">
                <header class="col-3">
                    <h2>{{ $product->getItem()->name }}</h2>
                    <img src="{{ asset('storage/' . $product->getItem()->img_path) }}" alt="" class="w-100">
                </header>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prix unité</th>
                                <th>Coût total</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->getItem()->price }}</td>
                                <td>{{ $product->getItem()->price * $product->getQuantity() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('cart-update', ["productId" => $product->getItemId()]) }}" method="POST">
                    @method("PUT")
                    @csrf
                    <input type="number" min="0" value="{{ $product->getQuantity() }}" max="{{ $product->getItem()->stock }}" name="quantity">
                    <button class="brand-btn">Editer</button>
                </form>
                <form action="{{ route('cart-destroy', ['productId' => $product->getItemId()] ) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="brand-btn">Supprimer</button>
                </form>
            </article>
        @endforeach
        <footer class="footer_section border p-3 mt-3">
            <h3>Coût total : </h3>
            <p>{{ $totalPrice }}$</p>
        </footer>
    </section>
@endsection

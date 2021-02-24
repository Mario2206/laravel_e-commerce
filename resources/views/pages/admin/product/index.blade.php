@extends('layouts.layout-admin')

@section('content')
    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container justify-content-between">
                <h2>
                    Tous les produits
                </h2>
                <div class="d-flex">
                    <a href="{{ route('products.create') }}" class="mx-2">Ajouter un produit</a>
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex flex-column align-items-center">
                        <select name="category" id="">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary my-2">Filtrer</button>
                    </form>
                </div>

            </div>
            <section class="brand_container layout_padding2">
                @foreach($products as $product)
                    <a href="{{ route("products.show", ["product" => $product->id]) }}" class="box">
                        <article >
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
                        </article>
                    </a>

                @endforeach
            </section>
            <footer class="d-flex justify-content-center">
                {{ $products->links() }}
            </footer>
        </div>
    </section>

@endsection

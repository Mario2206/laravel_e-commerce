@extends('layouts.layout-admin')

@section('content')
    <section class="brand_section layout_padding">
        <div class="container">
            <div class="heading_container justify-content-between">
                <h2>
                    Toutes les catégories ({{ count($categories) }})
                </h2>
                <a href="{{ route('categories.create') }}">Créer une catégorie</a>
            </div>
            <section class="brand_container layout_padding2">
                @foreach($categories as $category)
                    <article class="box">
                        <header class="img-box">
                            <img src="{{ asset('storage/' . $category->img_path) }}" alt="{{$category->name}} image">
                        </header>
                        <div class="detail-box">
                            <h6>
                                {{ $category->name }}
                            </h6>
                        </div>
                        <footer>
                            <a href="{{ route("categories.edit", ['category' => $category->id]) }}" class="btn btn-primary mb-2">Editer</a>
                            <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </footer>
                    </article>
                @endforeach
            </section>
        </div>
    </section>

@endsection

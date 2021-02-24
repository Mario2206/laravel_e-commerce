@extends('layouts.layout-admin')

@section('content')
    <section class="brand_section layout_padding container">
        <h1>Créer une catégorie</h1>
        <form action="{{ route('categories.update', ["category" => $category->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="d-flex flex-column">
                <label for="name" class="">Nom de la catégories</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column my-3">
                <label for="miniature">Téléversez une miniature pour la catégorie</label>
                <img class="col-3" src="{{ asset("storage") . "/" . $category->img_path }}" alt="">
                <input type="file" name="miniature" id="miniature">
                @error('miniature')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn brand-btn">Confirmer</button>
        </form>
        </div>
    </section>

@endsection

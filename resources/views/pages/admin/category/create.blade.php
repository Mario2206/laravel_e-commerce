@extends('layouts.layout-admin')

@section('content')
    <section class="brand_section layout_padding container">
        <h1>Créer une catégorie</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column">
                <label for="name" class="">Nom de la catégories</label>
                <input type="text" name="name" id="name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-column my-3">
                <label for="miniature">Téléversez une miniature pour la catégorie</label>
                <input type="file" name="miniature" id="miniature" >
                @error('miniature')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn brand-btn">Confirmer</button>
        </form>
        </div>
    </section>

@endsection

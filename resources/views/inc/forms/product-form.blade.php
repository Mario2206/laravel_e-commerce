<?php $isUpdate = isset($product) ?>

<form action="{{ route( !$isUpdate ? "products.store" : "products.update", $isUpdate ? ['product' => $product->id] : null) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isUpdate)
        @method("PUT")
    @endif
    <div class="d-flex flex-column my-3">
        <label for="name" class="">Nom</label>
        <input type="text" name="name" id="name" value="{{ $isUpdate ? $product->name : "" }}">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex flex-column my-3">
        <label for="price" class="">Prix</label>
        <input type="number" min="0" name="price" id="price" step="0.01" value="{{ $isUpdate ? $product->price : 0  }}">
        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex flex-column my-3">
        <label for="stock" class="">Stock</label>
        <input type="number" name="stock" id="stock" min="0" value="{{ $isUpdate ? $product->stock : 0  }}">
        @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex flex-column my-3">
        <label for="description" class="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ $isUpdate ? $product->description : "" }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex flex-column my-3">
        <label for="category" class="">Catégorie</label>
        <select name="category_id" id="category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $isUpdate && $category->id === $product->category_id ? "selected" : null }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex flex-column my-3">
        <label for="miniature">Téléversez une miniature pour le produit</label>
        @if($isUpdate)
            <img src="{{ asset("storage") . "/" . $product->img_path }}" alt="{{ $product->name }} image" class="col-3 py-3">
        @endif
        <input type="file" name="miniature" id="miniature" >
        @error('miniature')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary">Confirmer</button>
    </div>

</form>

@extends('layouts.layout-admin')

@section('content')

    <section class="brand_section layout_padding container">
        @include("inc.error-banner")
        <h1 class="text-center">Ajouter un produit</h1>
       @include("inc.forms.product-form")
    </section>

@endsection

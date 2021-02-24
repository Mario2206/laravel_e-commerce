<header class="card-header d-flex justify-content-between">
    <div class="d-flex">
        <strong>ADMIN</strong>
        <p class="m-0 pl-2">
            ({{ \Illuminate\Support\Facades\Auth::user()->name}})
        </p>
    </div>

    <nav class="d-flex align-items-center">
        <a href="{{ route("categories.index") }}" >Catégories</a>
        <a href="{{ route('products.index') }}" class="mx-5">Produits</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-dark">Déconnexion</button>
        </form>

    </nav>
</header>

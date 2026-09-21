<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Marketplace</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('products.index') }}">
            Marketplace
        </a>

        <div class="navbar-nav me-auto">

            <a class="nav-link" href="{{ route('products.index') }}">
                Products
            </a>




@auth
    <a class="nav-link" href="{{ route('cart.index') }}">
        Cart
    </a>

    <a class="nav-link" href="{{ route('wishlist.index') }}">
        Wishlist
    </a>
@endauth






                @auth
                    @if(auth()->user()->role === 'buyer')
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            My Orders
                        </a>
                    @endif
                @endauth

        </div>

        <div class="navbar-nav ms-auto">


            @auth
    <a class="nav-link" href="{{ route('profile.edit') }}">
        Profile
    </a>
@endauth
@auth
    @if(auth()->user()->role === 'seller')

        <a class="nav-link" href="{{ route('seller.products') }}">
            Seller Dashboard
        </a>


<a class="nav-link" href="{{ route('seller.orders') }}">
    Seller Orders
</a>



    @endif
@endauth


        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>
        @endauth

        </div>

    </div>
</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>





</body>
</html>
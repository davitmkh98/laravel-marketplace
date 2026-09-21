<x-app-layout>

    <h2>{{ $user->name }}</h2>

    @foreach($products as $product)

        <div>

            <h4>{{ $product->name }}</h4>

            <p>${{ $product->price }}</p>

        </div>

    @endforeach

    {{ $products->links() }}

</x-app-layout>
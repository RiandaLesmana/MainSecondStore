@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('index_product') }}" method="GET" class="input-group mt-3">
                    <input type="text" name="search" placeholder="Search products..." class="form-control">
                    <button type="submit" class="btn btn-info">Search</button>
                </form>
                <div class="card mt-4">

                    <div class="card-header bg-info text-white">
                        <h3 class="m-0">{{ __('Products') }}</h3>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <div class="card mx-2 mt-2 product-card">
                                    <img class="card-img-top" src="{{ url('storage/' . $product->image) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <form action="{{ route('show_product', $product) }}" method="get">
                                            <button type="submit" class="btn btn-primary">Show detail</button>
                                        </form>
                                        @if (Auth::check() && Auth::user()->is_admin)
                                            <form action="{{ route('delete_product', $product) }}" method="post"
                                                onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Produk Ini ?')">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete product</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

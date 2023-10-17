@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Product Detail') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-around align-items-center">
                            <div class="product-image">
                                <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    width="200px">
                            </div>
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                <h6 class="product-description">{{ $product->description }}</h6>
                                <h3 class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</h3>
                                <hr>
                                <p class="product-stock">{{ $product->stock }} left</p>
                                @if (!Auth::user()->is_admin)
                                    <form action="{{ route('add_to_cart', $product) }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" aria-describedby="basic-addon2"
                                                name="amount" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Add to cart</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('edit_product', $product) }}" method="get">
                                        <button type="submit" class="btn btn-secondary">Edit product</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">{{ __('Cart') }}</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @php
                            $total_price = 0;
                        @endphp

                        <div class="card-group">
                            @foreach ($carts as $cart)
                                <div class="card m-3">
                                    <img class="card-img-top" src="{{ url('storage/' . $cart->product->image) }}"
                                        alt="{{ $cart->product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $cart->product->name }}</h5>
                                        <label>______________________________________________________________________________________________</label>
                                        <form action="{{ route('update_cart', $cart) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <label>Kuantitas</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" aria-describedby="basic-addon2"
                                                    name="amount" value="{{ $cart->amount }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit">Update
                                                        amount</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{ route('delete_cart', $cart) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                @php
                                    $total_price += $cart->product->price * $cart->amount;
                                @endphp
                            @endforeach
                        </div>

                        <div class="cart-summary mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="total-price">Total: Rp{{ number_format($total_price, 0, ',', '.') }}</h5>
                                <form action="{{ route('checkout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"
                                        @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

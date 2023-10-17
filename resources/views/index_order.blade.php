@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Orders') }}</div>

                    <div class="card-body">
                        @foreach ($orders as $order)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <a href="{{ route('show_order', $order) }}" class="order-link">
                                        <h5 class="card-title">Kode Pemesanan: {{ $order->id }}</h5>
                                    </a>
                                    <h6 class="card-subtitle mb-2 text-muted">By: {{ $order->user->name }}</h6>

                                    <div class="order-status">
                                        @if ($order->is_paid)
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            <span class="badge badge-warning">Unpaid</span>
                                            @if ($order->payment_receipt)
                                                <div class="payment-receipt">
                                                    <a href="{{ url('storage/' . $order->payment_receipt) }}"
                                                        class="btn btn-primary">View Payment Receipt</a>
                                                    @if (Auth::user()->is_admin)
                                                        <form action="{{ route('confirm_payment', $order) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="btn btn-success" type="submit">Confirm Payment</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                        
                                        <!-- Delete Order Button -->
                                        @if (Auth::user()->is_admin)
                                            <form action="{{ route('delete_order', $order) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete Order</button>
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

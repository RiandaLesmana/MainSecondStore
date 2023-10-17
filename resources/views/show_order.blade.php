@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Order Detail') }}</div>

                    @php
                        $total_price = 0;
                    @endphp

                    <div class="card-body">
                        <h4 class="card-title">Kode Pemesanan: {{ $order->id }}</h5>
                        <h5 class="card-subtitle mb-2 text-muted">By: {{ $order->user->name }}</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Address: {{ $order->user->address }}</h5>

                        <div class="order-status">
                            @if ($order->is_paid)
                                <span class="product-name"></span>
                                <label>STATUS : <span style="color :green;">PAYMENT VERIFIED</span></label>
                            @else
                                <span class="product-name"></span>
                                <label>STATUS : <span style="color :red;">UNPAID</span></label>
                            @endif
                        </div>
                        <hr>
                        @foreach ($order->transactions as $transaction)
                            <div class="product-info">
                                <p class="product-name">{{ $transaction->product->name }}</p>
                                <p class="product-quantity">Quantity: {{ $transaction->amount }}</p>
                            </div>
                            @php
                                $total_price += $transaction->product->price * $transaction->amount;
                            @endphp
                        @endforeach
                        <hr>
                        <p class="total-price">Total: Rp{{ number_format($total_price, 0, ',', '.') }}</p>
                        <hr>

                        <!-- Form to display data from the confirm table -->
                        @if ($confirm)    
                            <form>
                                <div class="form-group">
                                    <label for="noresi">No. Resi</label>
                                    <input type="text" class="form-control" id="noresi" value="{{ $confirm->noresi }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="jaspeng">Kurir</label>
                                    <input type="text" class="form-control" id="jaspeng" value="{{ $confirm->jaspeng }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="order_id">Order ID</label>
                                    <input type="text" class="form-control" id="order_id" value="{{ $confirm->order_id }}" readonly>
                                </div>
                            </form>
                            
                            <!-- Button to mark order as arrived or display "Goods Received" -->
                            @if (!$confirm->is_delivered)
                                <form action="{{ route('confirm.arrive', $confirm) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary mt-3">Mark as Arrived</button>
                                </form>
                            @else
                                <p class="text-success mt-3">Goods Received</p>
                            @endif
                        @endif
                        <!-- End of form -->

                        @if (!$order->is_paid && $order->payment_receipt == null && !Auth::user()->is_admin)
                            <form action="{{ route('submit_payment_receipt', $order) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Upload your payment receipt</label>
                                    <input type="file" name="payment_receipt" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

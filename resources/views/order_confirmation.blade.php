@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Confirmation Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('confirm.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="jaspeng" class="form-label">Delivery Courier</label>
                                <select id="jaspeng" name="jaspeng" class="form-select" aria-label="Default select example">
                                    <option selected disabled hidden>Choose One</option>
                                    <option value="DHL">DHL</option>
                                    <option value="JNT">JNT</option>
                                    <option value="JNE">JNE</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="noresi" class="form-label">noresi</label>
                                <input type="text" id="noresi" name="noresi" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="kode_pemesanan" class="form-label">order_id</label>
                                <select id="kode_pemesanan" name="kode_pemesanan" class="form-select">
                                    @foreach($orders as $paidOrder)
                                        @if(!$paidOrder->confirm || !$paidOrder->confirm->is_delivered)
                                            <option value="{{ $paidOrder->id }}">{{ $paidOrder->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

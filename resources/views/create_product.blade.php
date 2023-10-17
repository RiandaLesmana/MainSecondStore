@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Create Product') }}</div>

                    <div class="card-body">
                        <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" placeholder="Enter the product name"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="description" placeholder="Enter the product description"
                                    class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('Price') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" name="price" id="price" placeholder="Enter the product price"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">{{ __('Stock') }}</label>
                                <input type="number" name="stock" id="stock" placeholder="Enter the product stock"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Image') }}</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Submit Data') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

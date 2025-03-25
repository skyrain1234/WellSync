@extends('frontend.layouts.master')

@section('content')
<style>
    .table td, .table th {
        vertical-align: middle !important;
    }
</style>
    <div class="container mt-4">
        <h2 class=" fw-bold">
            購物車
        </h2>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="h-100 gradient-custom">
                <div class="container py-5">
                    <div class="row d-flex justify-content-center my-4">
                        <div class="col-md-8">
                            @include('frontend.cart.layouts.cart-content')
                        </div>
                        <div class="col-md-4">
                            @include('frontend.cart.layouts.order')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

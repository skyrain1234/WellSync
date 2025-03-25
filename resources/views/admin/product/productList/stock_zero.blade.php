@extends('admin.layouts.app')

@section('title')
    庫存為 0 的產品
@endsection

@section('content')
    <section class="section mt-3">
        <div class="section-header">
            <h1>庫存為 0 的產品</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-6 align-items-center mt-2">
                                    <h4>庫存為 0 的產品</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('admin.product.productList.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> 新增產品</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

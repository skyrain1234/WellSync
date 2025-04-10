@extends('admin.layouts.app')

@section('title')
    庫存不足的產品
@endsection

@section('content')
    <section class="section mt-3">


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-6 align-items-center mt-2">
                                    <h4>庫存不足的產品</h4>
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

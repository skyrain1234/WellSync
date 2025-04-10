@extends('admin.layouts.app')
 
<!-- 網頁標題 -->
@section('title')
訂單一覽
@endsection

@section('content')
    <div class=" mt-3">
        <div class="card">
            <div class="card-header">訂單管理</div>
            <select id="statusFilter" class="form-control w-25 ms-auto me-auto mt-2 ">
                <option value="" class="bg-secondary">查看全部</option>
                <option value="pending" class="bg-secondary" selected>未處理</option>
                <option value="processing" class="bg-secondary">撿貨中</option>
                <option value="shipped" class="bg-secondary">運送中</option>
                <option value="completed" class="bg-secondary">已完成</option>
                <option value="canceled" class="bg-secondary">已取消</option>
            </select>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('#statusFilter').change(function() {
                var status = $(this).val();
                var table = $('#order-table').DataTable();
                
                // 設定額外的參數，讓 DataTable 重新載入時帶上 status
                table.ajax.url("{{ route('admin.order.index') }}?status=" + status).load();
            });
        });
    </script>
@endpush
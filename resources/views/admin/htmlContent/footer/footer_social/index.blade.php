@extends('admin.layouts.app')
 
<!-- 網頁標題 -->
@section('title')
頁尾社群管理
@endsection

@section('content')
    <div class=" mt-3">
        <div class="card">
            <div class="card-header">頁尾社群管理</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.htmlContent.footer_social.change-status')}}",
                    method: 'POST',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        Swal.fire({
                            title: '成功!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '確定'
                        }).then(function() {
                            $("#product-table").DataTable().ajax.reload(null, false)
                        });
                        
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
 

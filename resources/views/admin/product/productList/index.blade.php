@extends('admin.layouts.app')
<!-- 網頁標題 -->
@section('title')
產品一覽
@endsection

@section('content')
      <!-- Main Content -->
        <section class="section mt-3">
          <div class="section-header">
            <h1>產品一覽</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header ">
                    <div class="row">
                      <div class="col-6 align-items-center mt-2">
                        <h4>所有產品</h4>
                      </div>
                      <div class="col-6 text-end">
                          <a href="{{route('admin.product.productList.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> 新增產品</a>
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

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.product.productList.change-status')}}",
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
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush

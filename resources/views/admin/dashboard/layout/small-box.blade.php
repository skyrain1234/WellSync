<div class="row mt-2">
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info" data-type="orders">
        <div class="inner">
        <h3></h3>
        <p>未處理的訂單</p>
        </div>
        <div class="icon">
        <i class="ion">
            <ion-icon name="bag-handle-outline"></ion-icon>
        </i>
        </div>
        <a href="{{ route('admin.order.index') }}?status=pending" class="small-box-footer update-chart">詳細資訊<i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success"  data-type="inventory">
        <div class="inner">
        <h3><sup style="font-size: 20px">%</sup></h3>
        <p>庫存不足的商品</p>
        </div>
        <div class="icon">
        <i class="ion">
            <ion-icon name="cube"></ion-icon>
        </i>
        </div>
        <a href="{{ route('admin.product.stockZero') }}" class="small-box-footer update-chart">詳細資訊 <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning" data-type="users">
        <div class="inner">
        <h3 id="new-users"></h3>
        <p>新加入的會員</p>
        </div>
        <div class="icon">
        <i class="ion">
            <ion-icon name="person-add"></ion-icon>
        </i>
        </div>
        <a href="#" id="fetchNewUsers" class="small-box-footer update-chart" data-range="3">查看圖表 <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger" data-type="reports" >
        <div class="inner">
        <h3></h3>
        <p>近期網站瀏覽人次</p>
        </div>
        <div class="icon">
        <i class="ion">
            <ion-icon name="stats-chart"></ion-icon>
        </i>
        </div>
        <a href="#" class="small-box-footer update-chart">查看圖表 <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
</div>
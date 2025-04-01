<?php
    $sidebar = $sidebar ?? []; // 確保變數存在

?>
<!-- 側邊欄 -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard.index') }}" class="brand-link">
                <span class="brand-text font-weight-light">後臺管理系統</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-widget="treeview" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ $sidebar['dashboard'] ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>儀表板</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.customer.index') }}" class="nav-link {{ $sidebar['customer'] ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>會員管理</p>
                            </a>
                        </li>
                        <li class="nav-item {{ $sidebar['product']||$sidebar['category'] ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>產品管理</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ms-2">
                                    <a href="{{ route('admin.product.category.index') }}" class="nav-link {{ request()->is('admin/product/category*') ? 'active' : '' }}" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>產品類別列表</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ms-2">
                                    <a href="{{ route('admin.product.productList.index') }}" class="nav-link {{ request()->is('admin/product/productList*') ? 'active' : '' }}" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>產品一覽</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->is('admin/order*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-cart-shopping"></i>
                                <p>訂單管理</p>
                            </a>
                        </li>
                        <hr>
                        <!-- 網頁管理 -->
                        <li class="nav-item {{ $sidebar['htmlContent'] ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fa-brands fa-html5"></i>
                                <p>網頁管理</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <!-- 頁尾 -->
                            <ul class="nav nav-treeview">
                                <li class="nav-item ms-2 {{ $sidebar['htmlContent'] ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>頁尾管理(footer)</p>
                                        <i class="fas fa-angle-left right"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item ms-2">
                                            <a href="{{ route('admin.htmlContent.footer_info.index') }}" class="nav-link {{ request()->is('admin/htmlContent/footer_info*') ? 'active' : '' }}" >
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>聯絡資訊</p>
                                            </a>
                                        </li>
                                        <li class="nav-item ms-2">
                                            <a href="{{ route('admin.htmlContent.footer_social.index') }}" class="nav-link {{ request()->is('admin/htmlContent/footer_social*') ? 'active' : '' }}" >
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>社群媒體</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
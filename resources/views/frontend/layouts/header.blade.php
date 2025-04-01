<!-- navbar -->
<header id="fenghua_nav" class="@yield('header_class', 'fixed-top')">
    <nav class="navbar navbar-expand-md shadow navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{route('home.index')}}"><img src="{{asset('uploads/logoHorizontal.png')}}" width="200px" alt=""></a>
                <!-- rwd漢堡圖標 -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-black"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-md-auto text-center">
                        <li class="nav-item dropdown">
                            <button class="bg-btn-navbar" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <a class="nav-link dropdown-toggle fs-5" href="#">產品列表</a>
                            </button>
                            <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item fs-5" href="{{route('shop')}}">所有產品</a></li>
                                <!-- 定義在AppServiceProvider.php裡的全域變數 -->
                                @foreach($categories_name as $id => $category_name)
                                <li><a class="dropdown-item fs-5" href="{{ route('shop.category', ['id' => $id]) }}">{{ $category_name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <button class="bg-btn-navbar" onclick="location.href={{route('about')}}">
                                <a class="nav-link fs-5" href="{{route('about')}}" target="_blank">關於我們</a>
                            </button>
                        </li>
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <button class="bg-btn-navbar" onclick="location.href={{ route('login') }}">
                                            <a class="nav-link fs-5" href="{{ route('login') }}">{{ __('登入') }}</a>
                                        </button>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <button class="bg-btn-navbar" onclick="location.href={{ route('register') }}">
                                            <a class="nav-link fs-5" href="{{ route('register') }}">{{ __('註冊') }}</a>
                                        </button>
                                    </li>
                                @endif
                                @else
 
                                <li class="nav-item dropdown">
                                    <button class="bg-btn-navbar d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset( Auth::user()->avatar ?? 'uploads/avatars/default_avatar_5407167.png') }}" class="rounded-circle" height="30px" width="30px" >
                                        <a  class="nav-link dropdown-toggle fs-6 mt-1" href="#" >
                                            {{ Auth::user()->name }}
                                        </a>
                                    </button>

                                    <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item fs-5" href="{{ route('member.profile') }}">
                                            {{ __('會員管理') }}
                                        </a>
                                        <a class="dropdown-item fs-5" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('登出') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        <!-- 購物車 -->
                        <li class="nav-item">
                            <button class="bg-btn-navbar">
                                <a class="nav-link fs-5 position-relative" href="{{route('cart')}}" target="_blank">
                                    購物車
                                    <span class="badge  position-absolute cart-badge-nav" id="cart_quantity_nav"></span>
                                </a>
                            </button>
                        </li>
                        <!-- end購物車 -->
                    </ul>
                </div>
            </div>
        </nav>
</header>
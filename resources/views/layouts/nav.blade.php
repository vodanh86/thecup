<?php 
use App\Models\Category;

$cats = Category::where('show', 1)
        ->orderBy('order')
        ->get()
        ->groupBy('parent_id');

$parentId = $cats[0][0]->id;
?>
<!--Navigator-bar-->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="logo" height="40" src="{{url('resources/img/Logo.svg')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon material-icons material-icons-outlined">
            menu
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Trang chủ</a>
                </li>
                @foreach($cats[$parentId] as $menu) 
                    @if(isset($cats[$menu->id]))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{$menu->title}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($cats[$menu->id] as $subMenu) 
                            <li><a class="dropdown-item" href="{{ url('/category/'.$subMenu->slug) }}">{{$subMenu->title}}</a></li>
                                @if (!$loop->last)      
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/category/'.$menu->slug) }}">{{$menu->title}}</a>
                    </li>
                    @endif
                @endforeach
                <li class="nav-item">
                    <button class="btn" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </li>
            </ul>
            <div class="nav-register">
                @guest
                <button class="btn btn-light" type="submit" id="loginBtn">Đăng nhập</button>
                <button class="btn btn-light ms-1" type="submit" id="registerBtn">Đăng ký</button>
                @else
                <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('user/profile') }}">
                                Thông tin tài khoản
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </div>
</nav>
<!--Navigator-bar-end-->
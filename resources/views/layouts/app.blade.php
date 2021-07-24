<?php
use App\Admin\Controllers\Util;
use App\Models\Category;

?>
@include('layouts.header')
@yield('body')
@include('layouts.nav')

@yield('content')

@include('layouts.footer')
@include('layouts.script')
@yield('scripts')
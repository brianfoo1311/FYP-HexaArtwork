<!DOCTYPE html>
<html lang="en">
@include('layouts.css')
@yield('css')
<body>
<div id="app">
    @include('layouts.side-bar')
    <div id="main">
        @include('layouts.nav-bar')
        @yield('body')
    </div>
</div>
@include('layouts.js')
@yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@include('FrontEnd.layouts.css')
@yield('css')
<body>
@include('FrontEnd.layouts.nav')
@yield('body')
@include('FrontEnd.layouts.footer')
@include('FrontEnd.layouts.js')
@yield('js')
</body>
</html>

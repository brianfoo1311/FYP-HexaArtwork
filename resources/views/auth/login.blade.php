<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('admin/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/pages/auth.css')}}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.png')}}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
</head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <a href="{{url('/')}}"><img src="{{asset('admin/assets/images/logo/hexa-logo.png')}}" alt="Logo"></a>
                <h1 class="auth-title">Admin Login.</h1>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control form-control-xl" placeholder="E-mail" name="email"
                               required value="{{old('email')}}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password"
                               name="password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-block btn-lg shadow-lg mt-3">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Do not have an account?
                        <a href="{{route('register.view')}}" class="font-bold" style="color: #A82551">Sign up</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{--toastr--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(\Illuminate\Support\Facades\Session::has('success'))
    toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}", 'Success', {timeOut: 3000});
    @endif

    @if(\Illuminate\Support\Facades\Session::has('error'))
    toastr.error('{{\Illuminate\Support\Facades\Session::get('error')}}', 'Error', {timeOut: 3000});
    @endif
</script>
</html>

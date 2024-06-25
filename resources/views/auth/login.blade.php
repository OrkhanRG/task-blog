<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">


    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">

                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                                    <h5 class="text-muted fw-normal mb-4">Bu səhifədə login ola bilərsiniz.</h5>
                                    <form class="forms-sample" id="formLogin" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Şifrə</label>
                                            <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Password">
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                            <label class="form-check-label" for="authCheck">
                                                Məni xatırla
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary me-2 mb-2 mb-md-0 text-white" id="btnLogin">Daxil Ol</button>
                                        <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Qeydiyyatdan keç</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let email = document.querySelector("#email");
        let password = document.querySelector('#password');
        let btnLogin = document.querySelector('#btnLogin');
        let formLogin = document.querySelector('#formLogin');
        btnLogin.addEventListener('click', function () {
            if (email.value.trim() === '')
            {
                Swal.fire({
                    title: "Diqqət!",
                    text: "Email daxil etmək vacibdir!",
                    icon: "warning"
                });
            }
            else if (password.value.trim() === '' || email.value.trim().length < 3)
            {
                Swal.fire({
                    title: "Diqqət!",
                    text: "Şifrə daxil etmək vacibdir!",
                    icon: "warning"
                });
            }
            else {
                formLogin.submit();
            }
        });
    })
</script>
@include('sweetalert::alert')
</body>
</html>

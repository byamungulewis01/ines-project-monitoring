<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Project Monitaring') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Project Monitaring" name="description" />
    <meta content="BmgCodes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo-sm.png') }}">

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('images/logo-ines-ruhengeri.png') }}" class="card-logo card-logo-dark"
                        alt="logo dark" height="40">
                    <img src="{{ asset('images/logo-ines-ruhengeri.png') }}" class="card-logo card-logo-light"
                        alt="logo light" height="40">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">

                    </ul>

                    @if (auth()->guard('sponser')->check())
                        <div class="">
                            <a href="{{ route('sponser.projects') }}"
                                class="btn btn-link fw-medium text-decoration-none text-body">Dashboard</a>
                            <a href="{{ route('sponser.logout') }}" class="btn btn-danger">Logout</a>
                        </div>
                    @else
                        <div class="">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModals"
                                class="btn btn-link fw-medium text-decoration-none text-body">Sign in</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#signupModals"
                                class="btn btn-primary">Sign Up</a>
                        </div>
                    @endif
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div id="loginModals" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="modal-body login-modal p-5">
                        <h5 class="text-white fs-20">Login</h5>
                        <p class="text-white-50 mb-0">Don't have an account? <a href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#signupModals" class="text-white">Sign Up.</a>
                        </p>

                    </div>
                    <div class="modal-body p-5">
                        <h5 class="mb-3">Login with Email</h5>
                        <form method="POST" action="{{ route('sponser.login') }}">
                            @csrf
                            <div class="mb-2">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter your email/username">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter your password">
                                <div class="mt-1 text-end">
                                    <a href="#">Forgot password ?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="signupModals" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="modal-header p-3">
                        <h4 class="card-title mb-0">Sign Up - Sponser Account</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="{{ route('sponser.register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="fullName"
                                    placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="emailInput"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Enter your password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" required class="form-check-input" id="checkTerms">
                                <label class="form-check-label" for="checkTerms">I agree to the <span
                                        class="fw-semibold">Terms of Service</span> and Privacy Policy</label>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Sign Up Now</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        @yield('body')



    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                $(this).find("button[type=submit]").addClass('btn btn-outline-primary btn-load').html(`<span class="d-flex align-items-center">
                                        <span class="spinner-border flex-shrink-0" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                        <span class="flex-grow-1 ms-2">
                                            Loading...
                                        </span>
                                    </span>`).prop("disabled", true);
            });
        });
    </script>
    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- landing init -->
    <script src="{{ asset('assets/js/pages/landing.init.js') }}"></script>
</body>

</html>

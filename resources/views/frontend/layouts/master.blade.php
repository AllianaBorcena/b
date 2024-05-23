<!DOCTYPE html>
<html data-bs-theme="light" lang="en" data-bss-forced-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Bien By Tracy </title>
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/Font%20Awesome%205%20Brands.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/Font%20Awesome%205%20Free.css') }}">
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">
</head>

<body>
    <div>
        <div class="overlay-container d-none">
            <div class="overlay">
                <span class="loader"></span>
        </div>
    </div>

    <div class="fp__cart_popup">
        <div class="modal fade" role="dialog" tabindex="-1" id="cartModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body load_product_modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="fp__topbar" style="background:#f8cfc9;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xl-6">
                    <ul class="d-flex flex-wrap fp__topbar_info">
                        <li style="color:var(--colorBlack);"><i class="fas fa-envelope"></i><span style="color:rgb(0, 0, 0);">&nbsp;bienbytracy@gmail.com</span></li>
                        <li><a><i class="fas fa-phone-alt" style="color:rgb(0,0,0);"></i> +999999999</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-xl-6 d-none d-md-block">
                    <ul class="d-flex flex-wrap topbar_icon">
                        <li><i class="fab fa-facebook-f" style="margin:10px;"></i></li>
                        <li><i class="fab fa-instagram" style="margin:10px;"></i></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.menu')

    @yield('content')

    @include('frontend.layouts.footer')

    <div style="color: rgb(0,0,0);background: rgb(140,89,43);" class="fp__scroll_btn"><span style="color: rgb(255,255,255);font-weight: bold;"> go to top </span></div>
    <script src="{{ asset('frontend/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>

    <script>
        toastr.options.progressBar = true;
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @include('frontend.layouts.global-scripts')

    @stack('scripts')
</body>

</html>

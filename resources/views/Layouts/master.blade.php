<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="VibeFashion eyewear and accessories shop.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>VibeFashion</title>

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo1.png') }}">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        .main-menu-wrap {
            display: flex;
            align-items: center;
        }

        .site-logo {
            flex: 0 0 auto;
            margin-right: 35px;
        }

        .main-menu {
            flex: 1;
        }

        @media (max-width: 991px) {
            .main-menu-wrap {
                display: block;
            }

            .site-logo {
                margin-right: 0;
            }
        }
    </style>

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/img/logo1.png') }}" alt="VibeFashion">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li class="current-list-item"><a href="/home">Home</a>
                                </li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/products">Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="/products">All accessories</a></li>
                                        <li><a href="/category">Categories</a></li>
                                    </ul>
                                </li>
                                <li><a href="/cart">Cart</a>
                                    <ul class="sub-menu">
                                        <li><a href="/cart">Cart</a></li>
                                    </ul>
                                </li>
                                @auth
                                <li><a href="{{ route('profile') }}">{{ auth()->user()->name }}</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="nav-logout-form">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </li>
                                @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Sign up</a></li>
                                @endauth
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="/cart"><i class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Keywords" required>
                                <button type="submit">Search <i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Curated everyday style</p>
                                <h1>Eyewear and jewelry with a point of view</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">Shop accessories</a>
                                    <a href="/about" class="bordered-btn">Our story</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Details that define you</p>
                                <h1>Make your daily look unmistakably yours</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">Visit Shop</a>
                                    <a href="/about" class="bordered-btn">Our story</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">New season edit</p>
                                <h1>Statement pieces, made to be worn</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">Visit Shop</a>
                                    <a href="/about" class="bordered-btn">Our story</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->

    @yield('content')







    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About VibeFashion</h2>
                        <p>Curated eyewear and accessories for personal style that feels effortless, expressive, and entirely your own.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
                            <li>12 Talaat Harb Street, Downtown Cairo, Egypt</li>
                            <li>hello@vibefashion.com</li>
                            <li>+20 2 2795 4421</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="/home">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="/products">Shop</a></li>
                            <li><a href="/category">Categories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">Subscribe</h2>
                        <p>Subscribe to our mailing list to get the latest updates.</p>
                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Email" required>
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    @if (session('success'))
    <div class="container mt-4">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
    @endif
    @if (session('error'))
    <div class="container mt-4">
        <div class="alert alert-danger">{{ session('error') }}</div>
    </div>
    @endif
    @if ($errors->any() && ! request()->routeIs('login', 'register'))
    <div class="container mt-4">
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    </div>
    @endif

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; {{ date('Y') }} - <a href="/home">Ezz Ashraf</a>, All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->
    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- count down -->
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('assets/js/sticker.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const input = toggle.closest('.password-field').querySelector('input');
                const icon = toggle.querySelector('i');
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('fa-eye', !isPassword);
                icon.classList.toggle('fa-eye-slash', isPassword);
                toggle.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                toggle.setAttribute('title', isPassword ? 'Hide password' : 'Show password');
            });
        });
    </script>

</body>

</html>
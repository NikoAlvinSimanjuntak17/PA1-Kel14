
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','name-title')</title>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('users/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/floating-wpp.css')}}">
  <script src="{{asset('users/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('users/css/navbar.css')}}">
  <link href="{{asset('css/floating-wpp.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/floating-wpp.min.css')}}">
  @yield('css')
  @stack('css')
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">wijayafarma@gmail.com</a>
        <i class="bi bi-phone"></i>+62-222-22
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="https://www.facebook.com/profile.php?id=100009095737620&mibextid=ZbWKwL" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
        <a href="https://instagram.com/yesika_pradinatasitohang?igshid=ZGUzMzM3NWJiOQ==" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://api.whatsapp.com/send/?phone=%2B6282370771069&text&type=phone_number&app_absent=0" target="_blank" class="twitter"><i class="bi bi-whatsapp"></i></a>
      </div>
    </div>
  </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index.html"><img src="{{asset('users/img/20230327_153201.png')}}')}}" alt=""></a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="{{route('home')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route('product')}}">Products</a></li>
          <li><a class="nav-link scrollto" href="{{route('penyakit')}}">Deseases</a></li>
          {{-- {{-- <li><a class="nav-link scrollto" href="{{route('todaydeal')}}">Today's deal</a></li> --}}
          <li><a class="nav-link scrollto" href="{{route('about')}}">About</a></li>
          <li><a class="nav-link scrollto" href="#doctors"></a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <div class="d-flex p-1 me-3 nav-cart" style=""><a href="{{route('addtocart')}}" class="cart"><i class="bi bi-cart">&nbsp;Cart</i></a></div>
      <!-- .navbar -->
      @if (empty(Auth::user()->user_img))
      <img src="{{asset('users/img/profile.png')}}"  width="35px" height="35px" class="profil" onclick="toggleMenu()" alt="">
        @else
        <img src="{{asset(Auth::user()->user_img)}}"  width="35px" height="35px" class="profil" onclick="toggleMenu()" alt="">
      @endif
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
                        <div class="user-info">
                            @if (empty(Auth::user()->user_img))
                            <img src="{{asset('users/img/profile.png')}}" alt="">
                              @else
                              <img src="{{asset(Auth::user()->user_img)}}" alt="">
                            @endif
                            <h2>{{Auth::user()->name}}</h2>
                        </div><hr>
                        <a href="{{route('userprofile')}}" class="sub-menu-link">
                            <img src="{{asset('users/img/profile.png')}}" alt="">
                            <p class="ms-4">Profil</p>
                          <span>></span>
                        </a>
                    {{-- <a href="" class="sub-menu-link">
                        <img src="{{asset('users/img/setting.png')}}" alt="">
                        <p class="ms-4">edit Profil</p>
                        <span>></span>
                    </a> --}}

                      <form method="POST" action="{{ route('logout') }}" class="sub-menu-link">
                            @csrf
                            <img src="{{asset('users/img/logout.png')}}" alt="">
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>

                        </form>
                    </div>
                  </div>
    </div>
  </header>
  <!-- End Header -->
@yield('main-content')


    <!--
      - #FOOTER
    -->

    <footer class="footer">

        <div class="footer-top  reveal section">
          <div class="container">

            <div class="footer-brand">

              <a href="#" class="logo">

              </a>

              <ul class="social-list">

                <li>
                  <a href="https://www.facebook.com/profile.php?id=100009095737620&mibextid=ZbWKwL" target="_blank" class="social-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="https://instagram.com/yesika_pradinatasitohang?igshid=ZGUzMzM3NWJiOQ==" target="_blank" class="social-link">
                    <ion-icon name="logo-instagram"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="https://api.whatsapp.com/send/?phone=%2B6282370771069&text&type=phone_number&app_absent=0" target="_blank" class="social-link">
                    <ion-icon name="logo-whatsapp"></ion-icon>
                  </a>
                </li>

              </ul>

            </div>

            <div class="footer-link-box">

              <ul class="footer-list">

                <li>
                  <p class="footer-list-title">Contact Us</p>
                </li>

                <li>
                  <address class="footer-link">
                    <ion-icon name="location"></ion-icon>

                    <span class="footer-link-text">
                      Jl. Balige No.12, Sigumpar Dangsina, Kec. Sigumpar, Toba, Sumatera Utara 22384
                    </span>
                  </address>
                </li>

                <li>
                  <a href="tel:+557343673257" class="footer-link">
                    <ion-icon name="call"></ion-icon>

                    <span class="footer-link-text">+62 823-7077-1069</span>
                  </a>
                </li>

                <li>
                  <a href="mailto:footcap@help.com" class="footer-link">
                    <ion-icon name="mail"></ion-icon>

                    <span class="footer-link-text">kuy.apotek@gmail.com</span>
                  </a>
                </li>

              </ul>

              <ul class="footer-list">

                <li>
                  <p class="footer-list-title">My Account</p>
                </li>

                <li>
                  <a href="{{route('userprofile')}}" class="footer-link">
                    <ion-icon name="chevron-forward-outline"></ion-icon>

                    <span class="footer-link-text">My Account</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('addtocart')}}" class="footer-link">
                    <ion-icon name="chevron-forward-outline"></ion-icon>

                    <span class="footer-link-text">View Cart</span>
                  </a>
                </li>

              </ul>

              <div class="footer-list">

                <p class="footer-list-title">Outlet Opening Time</p>

                <table class="footer-table">
                  <tbody>

                    <tr class="table-row">
                      <th class="table-head" scope="row">Mon - Tue:</th>

                      <td class="table-data">8AM - 10PM</td>
                    </tr>

                    <tr class="table-row">
                      <th class="table-head" scope="row">Wed:</th>

                      <td class="table-data">8AM - 7PM</td>
                    </tr>

                    <tr class="table-row">
                      <th class="table-head" scope="row">Fri:</th>

                      <td class="table-data">7AM - 12PM</td>
                    </tr>

                    <tr class="table-row">
                      <th class="table-head" scope="row">Sat:</th>

                      <td class="table-data">9AM - 8PM</td>
                    </tr>

                    <tr class="table-row">
                      <th class="table-head" scope="row">Sun:</th>

                      <td class="table-data">Closed</td>
                    </tr>

                  </tbody>
                </table>

              </div>

              <div class="footer-list">

                <p class="footer-list-title">Newsletter</p>

                <p class="newsletter-text">
                  Officially been operating since may 2023 and will operate 24 hours every day.
                </p>


              </div>

            </div>

          </div>
        </div>

        <div class="footer-bottom">
          <div class="container">

            <p class="copyright">
              &copy; 2023 <a href="#" class="copyright-link">wijayafarma</a>. All Rights Reserved
            </p>

          </div>
        </div>

      </footer>
      <div id="myButton"></div>

  <script src="{{asset('users/js/navbar.js')}}"></script>
  <script src="{{asset('users/js/profil.js')}}"></script>
<script src="{{asset('users/js/scroll.js')}}"></script>
<script src="{{asset('users/js/jquery.min.js')}}"></script>
<script src=""></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script src="{{asset('users/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('users/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('users/js/custom.js')}}"></script>
    <script src="{{asset('users/js/bootstrap.bundle.min.js')}}"></script>

   <link rel="stylesheet" href="{{asset('users/js/jquery.min.js')}}">
   <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
 </script>
 <script>
    setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
    }, 5000);
</script>
<!-- Buat script wa -->
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{asset('css/floating-wpp.min.js')}}"></script>
<script src="{{asset('css/floating-wpp.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#myButton').floatingWhatsApp({
            phone: '+6282370771069',
            popupMessage: 'Selamat Datang Di Toko Obat Wijaya Farma!! Ada yang Bisa dibantu??',
            message: "Saya Ingin Bertanya",
            showPopup: true,
            showOnIE: false,
            headerTitle: 'Toko Obat Wijaya Farma!',
            headerColor: '#25D366',
            backgroundColor: '#25D366',
            buttonImage: '<img src="img/whatsapp.svg" />'
        });
    });
</script>

  @stack('js')
</body>

</html>

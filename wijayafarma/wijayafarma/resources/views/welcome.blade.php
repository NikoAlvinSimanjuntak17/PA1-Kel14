<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('https://unpkg.com/boxicons@latest/css/boxicons.min.css')}}" />
    <link href="{{asset('https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css')}}" rel="stylesheet" />
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <title>WijayaFarma</title>
  </head>

  <body>
    <div class="container">
      <header>
        <a href="." class="logo"><img src="img/20230327_162258.png" alt="" /> </a>
      </header>
      <section class="hero">
        <div class="hero-text">
          <div class="text">Your Partner In </div>
          <br />
          <p>
            Melayani berbagai keluhan tentang kesehatan yang<br />
            anda perlukan dan kami akan memberikan solusi yang terbaik..
          </p>
          <div class="ikon">
            <img src="{{asset('img/24-hours.png')}}" class="hour" />
            <img src="{{asset('img/add-to-cart.png')}}" class="keranjang" />
            <img src="{{asset('img/customer-service.png')}}" />
          </div>
          <a href="{{ route('login') }}" class="login">Login</a>
          <a href="{{ route('register') }}" class="register">Register</a>
        </div>
        <div class="hero-img">
          <img id="img-r" src="img/WhatsApp_Image_2023-02-16_at_21.09.03-removebg-preview.png" alt="" />
        </div>
        <div>
          <img class="logo-snake" src="img/Kuy_Apotek__4_-removebg-preview.png" alt="" />
        </div>
        <div class="icons">
          <a href="https://instagram.com/yesika_pradinatasitohang?igshid=ZGUzMzM3NWJiOQ==" target="_blank"><i class="ri-instagram-line"></i></a>
          <a href="https://api.whatsapp.com/send/?phone=%2B6282370771069&text&type=phone_number&app_absent=0" target="_blank"><i class="ri-whatsapp-fill"></i></a>
          <a href="https://www.facebook.com/profile.php?id=100009095737620&mibextid=ZbWKwL" target="_blank"><i class='bx bxl-facebook-square' ></i></a>
        </div>
      </section>
      <script></script>
    </div>
  </body>
</html>

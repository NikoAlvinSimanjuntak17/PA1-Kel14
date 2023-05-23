@php
    $status = session('status');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{asset('css/login.css')}}">


    </style>
</head>
<body>
    <h1 class="font">HEALTH</h1>
    <div class="container">
      <div>
        <img src="img/WhatsApp_Image_2023-02-16_at_21.09.03-removebg-preview.png" alt="" class="img-r" />
        <img src="img/ular.png" alt="" class="img-snake" />
        <img src="img/20230327_162258.png" alt="" class="apotek3" />
      </div>
      <div class="forms-container">
        <div class="signin">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <a href="../" class="back"><i class="ri-arrow-left-line"></i></a>
        <h2 class="title">Login</h2>
            <div class="input-field">
              <i class="ri-user-6-line"></i>
              <input type="text" id="name" placeholder="Username" name="name" value="{{ old('name') }}" required autofocus autocomplete="username" />
            </div>

        <div class="input-field">
            <i class="ri-key-line"></i>
            <input type="password" placeholder="password" id="password" name="password" required autocomplete="current-password" />
        </div>
        {{-- @if ($errors->has('password'))
            <div class="mt-2">
                @foreach ($errors->get('password') as $error)
                    <span>{{ $error }}</span>
                    @endforeach
                </div>
        @endif
    </div> --}}
{{--
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
        </label>
    </div> --}}

    <button type="submit" value="" class="btn solid">login</button>
    <a href="register.html"><input type="button" value="register" class="btn btnr solid" /></a><br /><br />
    <div class="social-media">
        <a href="#" class="social-icon">
          <i class="ri-instagram-line"></i>
        </a>
        <a href="#" class="social-icon">
          <i class="ri-whatsapp-fill"></i>
        </a>
        <a href="#" class="social-icon">
          <i class="ri-message-2-line"></i>
        </a>
      </div>
    </form>
  </div>
</div>
</div>

</body>

<!DOCTYPE html>
<html lang="az">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <title></title>
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
    <div class="signup">
<form method="POST" action="{{ route('register') }}">
   @csrf

   <a href="../" class="back"><i class="ri-arrow-left-line"></i></a>
   <h2 class="title">Register</h2>
   <div class="input-field">
     <i class="ri-user-6-line"></i>
     <input type="text" placeholder="name"  id="name"  name="name" value="{{ old('name') }}" required autofocus autocomplete="name"/>
     @error('name')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
   </div>

   <div class="input-field">
    <i class="ri-key-line"></i>
    <input type="email" placeholder="email" id="email"  name="email" value="{{ old('email') }}" required autocomplete="username"/>
  </div>
  @error('email')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror

        <div class="input-field">
            <i class="ri-key-line"></i>
            <input type="password" placeholder="password"  id="password" type="password" name="password" required autocomplete="new-password"/>
          </div>
          @error('password')
          <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
      @enderror

      <div class="input-field">
        <i class="ri-key-line"></i>
        <input type="password" placeholder="Confirm password" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"/>
      </div>
      @error('password_confirmation')
      <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
  @enderror

  <a href="{{ __('Register') }}"><input type="submit" value="Register" class="btn solid" /></a>
  <p>Already have account?</p>
  <a href="{{route('login')}}" class="a">sign in here</a><br /><br />
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

</form>
</body>
</html>

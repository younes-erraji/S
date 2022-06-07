<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (app()->getLocale() === 'ar') dir='rtl' @endif>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>- {{ __('login') }}</title>
    <link rel="icon" href="{{ asset('Logo/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/styles/authentication.css') }}" />
  </head>

  <body>
    <form class="main-form" method="POST" action="{{ route('login') }}">
      @csrf
      <h1>{{ __('login') }}</h1>
      <div class="username">
        <div>
          <label for="email">{{ __('email address') }} <span>*</span></label>
        </div>
        <input type="email" id="email" name="email" value="{{ old('email') }}" dir="auto" />
        @error('email')
        <span class="error">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div class="password">
        <div>
          <label for="password">{{ __('password') }} <span>*</span></label>
        </div>
        <input type="password" id="password" name="password" dir="auto" />
        @error('password')
        <span class="error">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div>
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
          {{ __('forgot your password?') }}
        </a>
        @endif
      </div>

      <div class="checkbox">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
          : '' }} />

        <label class="form-check-label" for="remember">
          {{ __('remember me') }}
        </label>
      </div>

      <button type="submit" class="submit">
        {{ __('login') }}
      </button>

    </form>
    <footer> &copy; {{ __('copyright') . __('D.I.E.F.') }} <br /> {{ __('all rights reserved') }}</footer>
  </body>

</html>

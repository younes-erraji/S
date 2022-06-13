<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>- Send password reset link</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.jpg') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap-card.css') }}">
</head>
<body>
  <div class="container">
    <main>
      <div class="card">
        <div class="card-header">Reset password</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
              <label for="email">E-mail address</label>

              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" autocomplete="email" autofocus dir="auto" />

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Send password reset link
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
  <div class="footer">
    <span>Copyright &copy; 2022 Somaya.</span>
    <ul>
        <li><i class="fa fa-facebook-square fa-2x"></i></li>
        <li><i class="fa fa-twitter-square fa-2x"></i></li>
        <li><i class="fa fa-linkedin-square fa-2x"></i></li>
        <li><i class="fa fa-google-plus-square fa-2x"></i></li>
    </ul>
  </div>
</body>
</html>

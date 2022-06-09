<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Send password reset link</title>
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap-card.css') }}">
  <style>
    main {
      width: 448px;
      margin: 0 auto;
      padding: 47px 0;
    }

    .card {
      width: 100%
    }

    @media (max-width: 474px) {
      main {
        width: 98%;
      }
    }
  </style>
</head>
<body>
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
</body>
</html>

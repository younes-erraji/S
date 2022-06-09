<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Confirm password</title>
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
    <div class="card-header">Confirm password</div>

    <div class="card-body">
      Please confirm your password before continuing

      <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
          <label for="password">Password</label>

          <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" autocomplete="current-password" dir="auto" />

            @error('password')
            <span class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <div>
            <button type="submit" class="btn btn-primary">
              Confirm password
            </button>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
              Forgot your password?
            </a>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reset password</title>
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
        <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}" />

          <div class="form-group">
            <label for="email">E-mail address</label>

            <div>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" autocomplete="email" autofocus dir="auto" />

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="password">Password</label>

            <div>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" autocomplete="new-password" />

              @error('password')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="password-confirm">Confirm password</label>

            <div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                autocomplete="new-password" />
            </div>
          </div>

          <div class="form-group">
            <div>
              <button type="submit" class="btn btn-primary">
                Reset password
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>

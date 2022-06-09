<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Verify your email address</title>
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
      <div class="card-header">Verify your email address</div>

      <div class="card-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
          A fresh verification link has been sent to your email address
        </div>
        @endif

        Before proceeding, please check your email for a verification link
        If you did not receive the email,
        <form class="main-form" method="POST" action="{{ route('verification.resend') }}">
          @csrf
          <button type="submit" class="btn btn-link">Click here to request another</button>.
        </form>
      </div>
  </main>
</body>
</html>

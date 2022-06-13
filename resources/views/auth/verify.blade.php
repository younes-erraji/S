<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>- Verify your email address</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.jpg') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap-card.css') }}" />
</head>
<body>
  <div class="container">
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

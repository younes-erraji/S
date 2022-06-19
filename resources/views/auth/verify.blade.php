<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>- Vérifiez votre adresse e-mail</title>
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
        <div class="card-header">Vérifiez votre adresse e-mail</div>

        <div class="card-body">
          @if (session('resent'))
          <div class="alert alert-success" role="alert">
            Un nouveau lien de vérification a été envoyé à votre adresse e-mail
          </div>
          @endif

          Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification
           Si vous n'avez pas reçu l'e-mail,
          <form class="main-form" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link">Cliquez ici pour en demander un autre</button>.
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

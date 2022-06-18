<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>- Home</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.jpg') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" /> --}}
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
        <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    </head>
    <body>
      {{--
      <div class="header">

        <div class="slider">
          <div class="overlay"></div>
          <div class = "container">
              <div class="intro">
                  <h2></h2>
                  <h3></h3>
                  <p></p>

              </div>
          </div>
        </div>
      </div>

      <div class="footer">
          <div class="container">
              <span>Copyright &copy; 2022 Somaya.</span>
              <ul>
                  <li><i class="fa fa-facebook-square fa-2x"></i></li>
                  <li><i class="fa fa-twitter-square fa-2x"></i></li>
                  <li><i class="fa fa-linkedin-square fa-2x"></i></li>
                  <li><i class="fa fa-google-plus-square fa-2x"></i></li>
              </ul>
          </div>
      </div>
      --}}

      <div class="overlay">
        <div class="overlay__inner">
          <h1 class="overlay__title">
            MINISTRE DE L'EQUIPEMENT, DU TRANSPORT DE LA LOGISTIQUE ET DE L'EAU
          </h1>
          <h2>Projet De Stage</h2>
          <p class="overlay__description">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque impedit quo incidunt. Nemo cupiditate, officia reprehenderit incidunt nulla accusantium molestias, laudantium ut magni doloremque quos soluta, velit explicabo corporis error ipsum! Consectetur voluptates incidunt quaerat iusto vero pariatur molestiae ad quo repellendus quae! Numquam.
          </p>
          <div class="overlay__btns">
            @auth
            <a href='/admin' class="overlay__btn overlay__btn--colors">
              <span>Tableau de bord</span>
              <span class="overlay__btn-emoji">🎨</span>
            </a>
            @else
            <a href='/login' class="overlay__btn overlay__btn--colors">
              <span>Connexion</span>
              <span class="overlay__btn-emoji">🎨</span>
            </a>
            @endauth
          </div>
        </div>
      </div>
    </body>
</html>

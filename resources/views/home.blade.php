<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>- Home</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.jpg') }}" />
        <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
        <link
          href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    </head>
    <body>
        <div class="header">

          <div class="slider">
            <div class="overlay"></div>
            <div class = "container">
                <div class="intro">
                    <h2 class="mas">Projet De Stage</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque impedit quo incidunt. Nemo cupiditate, officia reprehenderit incidunt nulla accusantium molestias, laudantium ut magni doloremque quos soluta, velit explicabo corporis error ipsum! Consectetur voluptates incidunt quaerat iusto vero pariatur molestiae ad quo repellendus quae! Numquam.</p>
                    @auth
                    <a href='/admin'>Dashboard</a>
                    @else
                    <a href='/login'>Login</a>
                    @endauth
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
    </body>
</html>

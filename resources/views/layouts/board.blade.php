<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>- @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/styles/board/utilities/board.css') }}" />
    @yield('style')
  </head>

  <body>
    <main>
      <div class="dashboard">
        <div class="x"><img src="{{ asset('assets/icons/x.svg') }}" /></div>
        <h1>
          <a><img src="{{ asset('assets/images/logo.jpg') }}" /></a>
        </h1>
        <ul>
          <li><a href="/admin" class='list'>Dashboard</a></li>
          <li>
            <a class='list' data-list="navires">Navires<i class="fa fa-angle-right"></i></a>
            <ul class="navires sublinks">
              <li><a href="/navires">List</a></li>
              <li><a href="/navires/create">Create</a></li>
            </ul>
          </li>
          <li>
            <a class='list' data-list="operations">Operations<i class="fa fa-angle-right"></i></a>
            <ul class="operations sublinks">
              <li><a href="/operations">List</a></li>
              <li><a href="/operations/create">Create</a></li>
            </ul>
          </li>
          <li>
            <a class='list' data-list="armateurs">Armateurs<i class="fa fa-angle-right"></i></a>
            <ul class="armateurs sublinks">
              <li><a href="/armateurs">List</a></li>
              <li><a href="/armateurs/create">Create</a></li>
            </ul>
          </li>
          <li>
            <a class='list' data-list="lignes">Lignes<i class="fa fa-angle-right"></i></a>
            <ul class="lignes sublinks">
              <li><a href="/lignes">List</a></li>
              <li><a href="/lignes/create">Create</a></li>
            </ul>
          </li>
          @role('superadministrator|administrator')
          <li class='only-admin'>- Admin</li>
          <li><a href="/history" class='list'>History</a>
          </li>
          <li>
            <a class='list' data-list="users">Users<i class="fa fa-angle-right"></i></a>
            <ul class="users sublinks">
              <li><a href="/users">List</a></li>
              <li><a href="/users/create">Create</a></li>
            </ul>
          </li>
          @endrole
        </ul>
      </div>
      <div class="content">
        <nav>
          <section>
            <div class="show-dashboard"><i class="fa fa-bars fa-2x"></i></div>
            <h2 class="header">@yield('title')</h2>
          </section>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </nav>
        <section>
          @yield('content')
        </section>

        <hr />
        <footer>
          <div>
            <span>
              &copy; Copyright Somaya.
              <br />
              All Rights Reserved.
            </span>
          </div>
          <ul class="socials">
            <li><a href="" name='facebook'><i class="fa fa-facebook-square fa-2x" data-social="facebook"></i></a></li>
            <li><a href="" name='twitter'><i class="fa fa-twitter-square fa-2x" data-social="twitter"></i></a></li>
            <li><a href="" name='google-plus'><i class="fa fa-google-plus-square fa-2x" name
                  data-social="google-plus"></i></a></li>
            <li><a href="" name='linkedin'><i class="fa fa-linkedin-square fa-2x" data-social="linkedin"></i></a></li>
          </ul>
        </footer>
      </div>
    </main>
    <script src="{{ asset('assets/scripts/board/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('assets/scripts/board/script.js') }}"></script>
    <script>
      const dropdown = document.querySelector('.dropdown-menu');
      navbarDropdown.onclick = function () {
        if (dropdown.style.display === 'block') {
          dropdown.style.display = 'none';
        } else {
          dropdown.style.display = 'block';
        }
      }
    </script>
    @yield('scripts')
  </body>

</html>

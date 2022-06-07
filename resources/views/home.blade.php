<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('assets/styles/utilities/normalize.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles/utilities/font-awesome.min.css') }}" />
  <style>
  .header .slider {
    background-image: url('./assets/images/landing.jpg');
    background-size: cover;
    min-height: 100vh;
}
.header .slider .intro {
    padding-top: 250px;
    text-align: center;
    color: #fff;
}
.header .slider .intro h2 {
    margin: 0 auto;
    font-size: 50px;
    width: 600px;
    border-top: 4px solid #fff;
    border-bottom: 4px solid #fff;
    padding: 5px 0;
}
.header .slider .intro a {
  display: inline-block;
    background: none;
    margin-top: 30px;
    font-size: 20px;
    border: 2px solid #fff;
    font-weight: bold;
    padding: 10px 30px;
}
.header .navbar {
    background-color:darkcyan;
    color: #FFF;
    overflow: hidden;
    text-transform: uppercase
}
.header .navbar h2 { float: left; }
.header .navbar h2 span { color: #2ecc71 }
.header .navbar ul {
    list-style: none;
    padding-left: 0;
    overflow: hidden;
    float: right
}
.header .navbar ul li { float: left;padding: 10px }
.header .navbar ul li a {
    color: #fff;
    text-decoration: none;
}
.header .navbar ul li.active a,
.header .navbar ul li a:hover {
    color: #30b576
}
  </style>
</head>
<body>
  <div class="header">
    <div class="slider">
        <div class = "container">
            <div class="intro">
                <h2 class="mas">Projet De Stage</h2>
                <a href='/login'>Login</a>
            </div>
        </div>
    </div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="skins/ice/css/app.css">
    <title>AdamHaley.com</title>

    <script src="js/app.js"></script>

</head>
<body class="{{ (empty(Route::current()->getName()) || strstr(Route::current()->getName(),'generated'))? 'splash' : Route::current()->getName() }}">
<!-- center div -->
<h1 id="ah">
    <span>AH</span>
    </div>
</h1>
    <!-- Page Content -->
    <main x-data="{headingtext:'{{strtoupper(Route::current()->getName())}}',headingtextdefault:'{{strtoupper(Route::current()->getName())}}'}">
        @yield('nav')

        @yield('content')

    </main>
<footer>&copy; 2000-2023 Adam Haley Productions</footer>
</body>
</html>

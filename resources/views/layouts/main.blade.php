<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="skins/ice/css/app.css">
    <link rel="stylesheet" href="css/animations.css">
    <title>AdamHaley.com</title>


</head>
<body class="{{ (empty(Route::current()->getName()) || strstr(Route::current()->getName(),'generated'))? 'splash' : Route::current()->getName() }}">
<!-- center div -->
<a href="/">
<h1 id="ah">
    <span>AH</span>
</h1>
</a>
<!-- end center div -->
<!-- Main Body -->
@if(!strstr(Route::current()->getName(),'splash'))
<div id="animations" class="home">
    <div id="group1">
        <div class="container">
            <div class="sphere" id="sphere1">
            </div>
            <div class="sphere" id="sphere2">
            </div>
        </div>
    </div>
    <div id="group2">
        <div class="container">
            <div class="sphere" id="sphere1">
            </div>
            <div class="sphere" id="sphere2">
            </div>
            <div id="orbit1">
                <div class="sphere" id="sphere3">
                </div>
            </div>
            <div id="orbit2">
                <div class="sphere" id="sphere4">
                </div>
            </div>
            <div id="orbit3">
                <div class="sphere" id="sphere5">
                </div>
                <div class="sphere" id="sphere6">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    <!-- Page Content -->
    <main x-data="{clicked:false,headingtext:'{{strtoupper(Route::current()->getName())}}',headingtextdefault:'{{strtoupper(Route::current()->getName())}}'}">
        @yield('nav')

        @yield('content')

    </main>
<footer>&copy;2025 Adam Haley Productions</footer>


<script src="js/app.js"></script>

@env('local')
    <script src="http://localhost:35729/livereload.js"></script>
@endenv

</body>
</html>

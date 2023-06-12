<!-- nav -->
@if(Route::getCurrentRoute() === 'splash' && env('APP_ENV') !== 'local')
    hi
@else
    <nav>
            <ul>
                @include('partials.navlink', ['link' => 'worx', 'text' => 'WORX'])
                @include('partials.navlink', ['link' => 'songs', 'text' => 'SONGS'])
                @include('partials.navlink', ['link' => 'blog', 'text' => 'BLOG'])
                @include('partials.navlink', ['link' => 'contact', 'text' => 'CONTACT'])
            </ul>
    </nav>
@endif
<!-- end nav -->

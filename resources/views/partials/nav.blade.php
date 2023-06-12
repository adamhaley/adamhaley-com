<!-- nav -->
@if(strstr(Route::current()->getName(),'splash') && env('APP_ENV') !== 'local')
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

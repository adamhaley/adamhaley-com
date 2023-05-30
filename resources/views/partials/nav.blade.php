<!-- nav -->
 @if(env('APP_ENV') == 'local' || env('APP_ENV') == 'development')
        <nav>
            <ul>
                @include('partials.navlink', ['link' => 'home', 'text' => 'HOME'])
                @include('partials.navlink', ['link' => 'worx', 'text' => 'WORX'])
                @include('partials.navlink', ['link' => 'songs', 'text' => 'SONGS'])
                @include('partials.navlink', ['link' => 'blog', 'text' => 'BLOG'])
                @include('partials.navlink', ['link' => 'contact', 'text' => 'CONTACT'])
            </ul>
        </nav>
@endif
<!-- end nav -->

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

<!--lines effect for splash page -->
    <div class="lines">
        <div class="line1 hide" :class="headingtext==='WORX'?'show':'hide'"> </div>
        <div class="line2 hide" :class="headingtext==='SONGS'?'show':'hide'"></div>
        <div class="line3 hide" :class="headingtext==='BLOG'?'show':'hide'"></div>
        <div class="line4 hide" :class="headingtext==='CONTACT'?'show':'hide'"></div>
    </div>

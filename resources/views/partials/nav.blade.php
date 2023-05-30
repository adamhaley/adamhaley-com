<!-- nav -->
 @if(env('APP_ENV') == 'local' || env('APP_ENV') == 'development')
        <nav>
            <ul>
                <li><a class="navlink" href="{!! route('home') !!}">Home</a></li>
                <li><a class="navlink" href="{!! route('ahworx') !!}">AH:Worx</a></li>
                <li><a class="navlink" href="{!! route('ahsongs') !!}">AH:Songs</a></li>
                <li><a class="navlink" href="{{ route('blog') }}">Blog</a></li>
                <li><a class="navlink" href="{!! route('contact') !!}">Contact</a></li>

            </ul>
        </nav>
@endif
<!-- end nav -->

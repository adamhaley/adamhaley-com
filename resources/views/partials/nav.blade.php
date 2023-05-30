<!-- nav -->
 @if(env('APP_ENV') == 'local')
        <nav>
            <ul>
                <li><a href="{!! route('home') !!}">Home</a></li>
                <li><a href="{!! route('ahworx') !!}">AH:Worx</a></li>
                <li><a href="{!! route('ahsongs') !!}">AH:Songs</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{!! route('contact') !!}">Contact</a></li>

            </ul>
        </nav>
@endif
<!-- end nav -->

<!-- nav -->
 @if(env('APP_ENV') == 'local' || env('APP_ENV') == 'development')
        <nav>
            <ul>
               <li><a class="navlink" href="{!! route('home') !!}" @mouseover="headingtext='HOME'"  @mouseleave="""headingtext=headingtextdefault">Home</a></li>
                <li><a class="navlink" href="{!! route('worx') !!}" @mouseover="headingtext='WORX'"  @mouseleave="headingtext=headingtextdefault">AH:Worx</a></li>
                <li><a class="navlink" href="{!! route('songs') !!}" @mouseover="headingtext='SONGS'"  @mouseleave="headingtext=headingtextdefault">AH:Songs</a></li>
                <li><a class="navlink" href="{{ route('blog') }}" @mouseover="headingtext='BLOG'"  @mouseleave="headingtext=headingtextdefault">Blog</a></li>
                <li><a class="navlink" href="{!! route('contact') !!}"  @mouseover="headingtext='CONTACT'"  @mouseleave="headingtext=headingtextdefault">Contact</a></li>

            </ul>
        </nav>
@endif
<!-- end nav -->

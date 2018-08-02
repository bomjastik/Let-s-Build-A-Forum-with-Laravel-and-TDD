<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="channels" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Browse
                    </a>
                    <div class="dropdown-menu" aria-labelledby="channels">
                        <a class="dropdown-item" href="{{ route('threads.index') }}">
                            All Threads
                        </a>
                        @auth()
                            <a class="dropdown-item"
                               href="{{ route('threads.index') . '?by='. auth()->user()->name }}">
                                My Threads
                            </a>
                        @endauth
                        <a class="dropdown-item"
                           href="{{ route('threads.index') . '?popular=1' }}">
                            Popular All Time
                        </a>
                    </div>
                </li>

                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('threads.create') }}">New Thread</a>
                    </li>
                @endauth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="channels" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Channels
                    </a>
                    <div class="dropdown-menu" aria-labelledby="channels">
                        @if ($channels->isNotEmpty())
                            @foreach($channels as $channel)
                                <a class="dropdown-item" href="{{ $channel->url }}">
                                    {{ $channel->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fal fa-user-cog"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ auth()->user()->profileLink }}">
                                <i class="fal fa-user"></i>
                                {{ __('Profile') }}
                            </a>

                            <div class="dropdown-divider"></div>


                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fal fa-sign-out"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
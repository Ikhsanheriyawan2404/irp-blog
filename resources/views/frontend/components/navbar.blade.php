<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home' )}}">IRP <i class="fas fa-grimace"></i></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="search">
                <form action="{{ route('post.search') }}">
                    <input type="text" placeholder="Cari . . ." name="query">
                        <span>
                            <i class="fas fa-search"></i>
                        </span>
                    </input>
                </form>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item {{ request()->routeIs('about_us') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about_us') }}">Tentang Kami</a>
                </li>
                <li class="nav-item {{ request()->routeIs('gallery') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('gallery') }}">Galeri</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown {{ request()->routeIs('user.show') ? 'active' : ''}}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">Profil</a>
                            @if (auth()->user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropleft">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge badge-success"><i class="fas fa-bell"></i>{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <form id="markAsRead-form" action="{{ route('markAsRead') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item text-success" onclick="event.preventDefault();
                               document.getElementById('markAsRead-form').submit();"><small>Tandai semua telah dibaca</small></a>
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                @if ($notification->type == 'App\Notifications\LikeNotifications')
                                    <a href="{{ route('post', $notification->data['post']['slug']) }}" class="dropdown-item"><small>{{ $notification->data['user']['name'] }} Menyukai postingan Anda</small></a>
                                @elseif($notification->type == 'App\Notifications\CommentNotifications')
                                    <a href="{{ route('post', $notification->data['post']['slug']) }}" class="dropdown-item"><small>{{ $notification->data['user']['name'] }} Komentar dipostingan Anda</small></a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

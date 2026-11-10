<header class="header">
    <a class="logo" href="{{ route('calculator') }}">
        <span class="logo-icon">@include('partials.logo-mark')</span>
        <div>
            <h1>Копи-Копилка</h1>
            <span class="sub">✨ Копи и копи! ✨</span>
        </div>
    </a>
    
    <div class="header-actions">
        <span class="user-counter">
            <span class="heart">❤️</span> <span id="userCount">{{ number_format(rand(2800, 3500)) }}</span> копят с нами
        </span>
        
        @auth
            <span class="user-badge" id="userBadge">
                <span class="avatar">{{ auth()->user()->name[0] ?? 'К' }}</span>
                <span id="userNameDisplay">{{ auth()->user()->name }}</span>
            </span>
            
            <div class="header-auth-actions">
                <a href="{{ route('profile') }}" class="btn-header-outline">
                    👤 Профиль
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-header-danger">
                        🚪 Выйти
                    </button>
                </form>
            </div>
        @else
            <div class="header-auth-actions">
                <a href="{{ route('login') }}" class="btn-header-outline">
                    🔑 Войти
                </a>
                <a href="{{ route('register') }}" class="btn-header-primary">
                    📝 Регистрация
                </a>
            </div>
        @endauth
        
        <button class="theme-toggle" id="themeToggle">
            @if(session('theme', 'light') === 'dark')
                ☀️ Светлая
            @else
                🌙 Тёмная
            @endif
        </button>
    </div>
</header>
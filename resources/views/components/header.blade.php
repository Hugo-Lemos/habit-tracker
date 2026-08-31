<header class="bg-white border-b-2 flex items-center justify-between p-4">
    <div>
        <a href="{{ route('site.dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
        </a>
        
    </div>
    <div>

        @auth
            <form class="inline" action="{{ route('auth.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-white p-2 habit-shadow rounded hover:bg-habit-orange transition-colors cursor-pointer">Sair</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('site.login') }}" class="bg-white p-2 habit-shadow rounded hover:bg-habit-orange transition-colors cursor-pointer">Login</a>
        @endguest

    </div>
</header>
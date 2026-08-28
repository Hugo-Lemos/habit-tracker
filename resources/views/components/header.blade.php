<header class="bg-white border-b-2 flex items-center justify-between p-4">
    <div>
        logo
    </div>
    <div>

        @auth
            <form class="inline" action="{{ route('auth.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-white p-2 border-2 rounded hover:bg-orange-500 transition-colors cursor-pointer">Sair</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('site.login') }}" class="bg-white p-2 border-2 rounded hover:bg-orange-500 transition-colors cursor-pointer">Login</a>
        @endguest

    </div>
</header>
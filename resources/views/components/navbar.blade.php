<nav>
    <ul class="flex gap-4 items-center">
        <li>
            <a href="{{ route('site.dashboard') }}" class="{{ Route::is('site.dashboard') ? 'font-bold underline' : '' }} text-md border-r-2 pr-2 border-habit-orange hover:underline">Hoje</a>
        </li>
        <li>
            <a href=# class=" text-md border-r-2 pr-2 border-habit-orange hover:underline">Histórico</a>
        </li>
        <li>
            <a href=# class=" text-md border-r-2 pr-2 border-habit-orange hover:underline">Calendário</a>
        </li>
        <li>
            <a href="{{ route('habits.settings') }}" class="{{ Route::is('habits.settings') ? 'font-bold underline' : '' }} text-md pr-2 hover:underline">Gerenciar Hábitos</a>
        </li>
    </ul>
</nav>
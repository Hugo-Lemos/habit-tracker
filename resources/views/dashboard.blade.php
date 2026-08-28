<x-layout>
    
    <main class="py-10">
        <h1 class="text-center">
            Dashboard
        </h1>

        <p>
            Bem vindo, {{ auth()->user()->name }}!
        </p>

        <div>
            <h2 class="text-xl mt-4">Listagem dos hábitos</h2>

            <ul class="flex flex-col gap-2">
                @forelse($habits as $habit)
                    <li class="pl-4">
                        <div class="flex gap-2 items-center">
                            <p class="font-bold text-xl">
                                 - {{ $habit->name }}
                            </p>
                            <p>
                                ({{ $habit->habitLogs->count() }})
                            </p>
                        </div>
                    </li>
                @empty
                    <li>
                        <p>Nenhum hábito encontrado.</p>
                    </li>
                    
                @endforelse
                <li>
                    <p>
                        <a href="/habito/cadastrar" class="bg-white p-2 border-2">
                            Criar novo hábito
                        </a>
                    </p>
                </li>
            </ul>
            
        </div>
    </main>
</x-layout>
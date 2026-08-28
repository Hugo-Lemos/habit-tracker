<style>
    #success-message, #error-message {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
    }
</style>

<x-layout>
    
    <main class="py-10">
        <h1 class="font-bold text-4xl text-center">
            Dashboard
        </h1>

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
                            <a href="{{ route('habit.create') }}" class="bg-white p-2 border-2 rounded hover:bg-orange-500 transition-colors">
                            Criar novo hábito
                        </a>
                    </p>
                </li>
            </ul>
            
        </div>

        @session('success')
            <div id="success-message" class="bg-green-200 text-green-700 text-center p-2 border-2 border-green-400 font-bold rounded mb-4 max-w-[400px]">
                {{ session('success') }}
            </div>
        @endsession

        @session('error')
            <div id="error-message" class="bg-red-200 text-red-700 text-center p-2 border-2 border-red-400 font-bold rounded mb-4 max-w-[400px]">
                {{ session('error') }}
            </div>
        @endsession

    </main>
</x-layout>
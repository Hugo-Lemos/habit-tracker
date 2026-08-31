<style>
    @keyframes slideIn {
        from {
            opacity: 1;
            transform: translateX(-100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 1;
            transform: translateX(-100%);
        }
    }

    #success-message, #error-message {
        position: fixed;
        top: 20px;
        left: 10%;
        z-index: 9999;
        animation: slideIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    #success-message.hide, #error-message.hide {
        animation: slideOut 0.8s ease-out forwards;
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
                            <p>
                                <form action="{{ route('habit.destroy', $habit->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este hábito?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white p-1 cursor-pointer rounded hover:bg-red-700 hover:shadow-md transition-colors">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
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

<script>
    function initializeAlert(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            // Remove o elemento após 10 segundos
            setTimeout(() => {
                element.classList.add('hide');
                // Remove do DOM após a animação de saída
                setTimeout(() => {
                    element.remove();
                }, 500);
            }, 10000);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initializeAlert('success-message');
        initializeAlert('error-message');
    });
</script>
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
    
    <main class="py-10 min-h-[calc(100vh-160px)] px-4">

    <x-navbar/>

        <div>
            <h2 class="text-lg mt-8 mb-2">
                {{ date('d/m/Y') }}
            </h2>

            <ul class="flex flex-col gap-2">
                @forelse($habits as $habit)
                    <li class="habit-shadow p-2 bg-[#FFDAAC]">
                        <form method="POST" action="{{ route('habit.toggle', $habit->id) }}" id="toggle-form-{{ $habit->id }}" class="flex gap-2 items-center">
                            @csrf
                            <input type="checkbox" class="habit-toggle" {{ $habit->is_completed ? 'checked' : '' }} 
                            {{ $habit->wasCompletedToday() ? 'checked' : '' }}
                            onchange="document.getElementById('toggle-form-{{ $habit->id }}').submit();" />
                            <p class="font-bold text-lg">
                                {{ $habit->name }}
                            </p>
                        </form>
                    </li>
                @empty
                    <li>
                        <p>Nenhum hábito encontrado.</p>
                    </li>
                    
                @endforelse
                <li>
                    <p class="mt-4">
                        <a href="{{ route('habit.create') }}" class="bg-white p-2 font-bold habit-shadow rounded hover:bg-habit-orange transition-colors">
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
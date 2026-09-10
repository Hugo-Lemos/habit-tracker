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
    
    <main class="max-w-5xl mx-auto py-10 min-h-[calc(100vh-160px)] px-4 ">

        <x-navbar/>
        <br>

            @forelse($habits as $habit)
                <x-contribution :$habit :currentYear="$currentYear" :startDate="$startDate" :endDate="$endDate"/>
                @empty
                <div>
                    <p class="text-black">
                    Nenhum hábito para exibir histórico.
                    </p>
                    <a href="{{ route('habits.create') }}" class="underline ">
                    Crie um novo hábito
                    </a>
                </div>
            @endforelse

            <p class="mt-4">
                <a href="{{ route('habit.create') }}" class="bg-white p-2 font-bold habit-shadow rounded hover:bg-habit-orange transition-colors">
                    Criar novo hábito
                </a>
            </p>

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
<x-layout>
    <main class="py-10 min-h-[calc(100vh-160px)]">
        <h1 class="text-center">
            Veja seus hábitos ganharem vida
        </h1>

        @auth
            <p class="text-center mt-4">
                Bem vindo, {{ auth()->user()->name }}! 
            </p>
        @endauth
    </main>
</x-layout>
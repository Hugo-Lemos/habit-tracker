<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-center font-bold text-4xl text-center">
            Veja seus hábitos ganharem vida
        </h1>

        @auth
            <p class="text-center mt-4">
                Bem vindo, {{ auth()->user()->name }}! 
            </p>
        @endauth
    </main>
</x-layout>
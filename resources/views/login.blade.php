<x-layout>
    <main class="py-10">
        <h1 class="text-center">
            Faça Login
        </h1>

        <section class="mt-4">
            <form action="/login" method="POST">
                @csrf

                @error('message')
                    <p class="text-red-500 text-x1 mt-1">{{ $message }}</p>
                @enderror

                <input type="email" name="email" placeholder="seu@email.com" class="bg-white p-2 border-2 rounded">
                <input type="password" name="password" placeholder="********" class="bg-white p-2 border-2 rounded">
                <button type="submit" class="bg-white border-2 p-2 rounded">Entrar</button>
                
            </form>
            
        </section>
    </main>
</x-layout>
<x-layout>
    <main class="py-10">

        <section class="bg-white max-w-[600px] mx-auto p-10 pb-6 border-2 mt-4">

            <h1 class=" font-bold text-3xl mb-4">
                Registre-se
            </h1>

            <p>Insira seus dados para criar uma conta</p>

            <form action="{{ route('auth.register') }}" method="POST" class="flex flex-col">
                @csrf

                <div class="flex flex-col gap-2 mb-4">
                    <label for="name">Nome</label>
                    <input type="text" 
                        name="name" 
                        placeholder="Seu nome" 
                        class="bg-white p-2 border-2 rounded @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-4">
                    <label for="email">Email</label>
                    <input type="email" 
                        name="email" 
                        placeholder="seu@email.com" 
                        class="bg-white p-2 border-2 rounded @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-4">
                    <label for="password">Senha</label>
                    <input type="password" 
                        name="password" 
                        placeholder="********" 
                        class="bg-white p-2 border-2 rounded @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-4">
                    <label for="password_confirmation">Confirme sua senha</label>
                    <input type="password" 
                        name="password_confirmation" 
                        placeholder="********" 
                        class="bg-white p-2 border-2 rounded @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="bg-white border-2 p-2 rounded hover:cursor-pointer">
                    Registrar
                </button>
                
            </form>
            <p class="text-center mt-4">
                Já tem uma conta? 
                <a href="{{ route('site.login') }}"
                    class="text-blue-500 hover:underline hover:opacity-75 transition ">
                    Faça Login
                </a>
            </p>
            
        </section>
    </main>
</x-layout>
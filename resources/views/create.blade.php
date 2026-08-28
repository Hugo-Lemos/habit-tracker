<x-layout>
    
    <main class="py-10">
        <h1 class="font-bold text-4xl text-center">
            Cadastrar Hábito
        </h1>
        <section class="bg-white max-w-[600px] mx-auto p-10 pb-6 border-2 mt-4">
        
        <form action="{{ route('habit.store') }}" method="POST" class="flex flex-col gap-2">
            @csrf
            <div class="flex flex-col gap-2 mb-2">
                <label for="name">Nome do hábito</label>
                <input type="text" name="name" id="name" placeholder="Nome do hábito" class="bg-white p-2 border-2 rounded @error('name') border-red-500 @enderror" required>

                <button type="submit" class="bg-white p-2 border-2 rounded hover:bg-orange-500 transition-colors cursor-pointer">
                    Cadastrar hábito
                </button>
            </div>
        </form>
        </section>
        
    </main>
</x-layout>
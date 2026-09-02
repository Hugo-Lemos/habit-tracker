<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitController extends Controller
{
    public function create(): View
    {
        return view('create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:habits,name,NULL,id,user_id,'.auth()->id(),
            ],
        ], [
            'name.unique' => 'Você já possui um hábito com este nome.',
        ]);

        auth()->user()->habits()->create($validated);

        return redirect()->route('site.dashboard')->with('success', 'Hábito criado com sucesso!');
    }

    public function edit($habitId): View
    {
        if (! auth()->user() || ! auth()->user()->habits()->where('id', $habitId)->exists()) {
            abort(403, 'Hábito não encontrado ou você não tem permissão para editá-lo.');
        }
        $habit = auth()->user()->habits()->findOrFail($habitId);

        return view('edit', compact('habit'));
    }

    public function update(Request $request, $habitId): RedirectResponse
    {
        $habit = auth()->user()->habits()->findOrFail($habitId);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:habits,name,'.$habit->id.',id,user_id,'.auth()->id(),
            ],
        ], [
            'name.unique' => 'Você já possui um hábito com este nome.',
        ]);

        $habit->update($validated);

        return redirect()->route('site.dashboard')->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(Request $request, $habitId): RedirectResponse
    {
        if (! $request->user() || ! $request->user()->habits()->where('id', $habitId)->exists()) {
            return redirect()->route('site.dashboard')->with('error', 'Hábito não encontrado ou você não tem permissão para excluí-lo.');
        }
        $habit = auth()->user()->habits()->findOrFail($habitId);
        $habit->delete();

        return redirect()->route('site.dashboard')->with('success', 'Hábito excluído com sucesso!');
    }

    public function settings(): View
    {
        $habits = auth()->user()->habits;

        return view('components.settings', compact('habits'));
    }

    public function toggle(Habit $habit)
    {
        if (auth()->id() !== $habit->user_id) {
            abort(403, 'Você não tem permissão para este hábito.');
        }

        $today = Carbon::today()->toDateString();
        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->whereDate('completed_at', $today)
            ->first();

        // verificar se já existe um registro para o hábito e a data atual
        if ($log) {
            // se existir, deletar o registro
            $log->delete();
            $message = 'Hábito desmarcado com sucesso!';
        } else {
            // se não existir, criar o registro
            HabitLog::create([
                'user_id' => auth()->id(),
                'habit_id' => $habit->id,
                'completed_at' => $today,
            ]);

            $message = 'Hábito marcado com sucesso!';
        }

        // Retornar para a página anterior com uma mensagem
        return redirect()
            ->back()
            ->with('success', $message);
    }
}

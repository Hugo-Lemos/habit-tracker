<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
                'unique:habits,name,NULL,id,user_id,' . auth()->id(),
            ],
        ], [
            'name.unique' => 'Você já possui um hábito com este nome.',
        ]);

        auth()->user()->habits()->create($validated);

        return redirect()->route('site.dashboard')->with('success', 'Hábito criado com sucesso!');
    }

    public function edit($habitId): View
    {
        if(!auth()->user() || !auth()->user()->habits()->where('id', $habitId)->exists()) {
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
                'unique:habits,name,' . $habit->id . ',id,user_id,' . auth()->id(),
            ],
        ], [
            'name.unique' => 'Você já possui um hábito com este nome.',
        ]);

        $habit->update($validated);

        return redirect()->route('site.dashboard')->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(Request $request, $habitId): RedirectResponse
    {
        if(!$request->user() || !$request->user()->habits()->where('id', $habitId)->exists()) {
            return redirect()->route('site.dashboard')->with('error', 'Hábito não encontrado ou você não tem permissão para excluí-lo.');
        }
        $habit = auth()->user()->habits()->findOrFail($habitId);
        $habit->delete();

        return redirect()->route('site.dashboard')->with('success', 'Hábito excluído com sucesso!');
    }
}

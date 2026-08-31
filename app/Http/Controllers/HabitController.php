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
}

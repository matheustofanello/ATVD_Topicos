<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $categorias = Categoria::latest()->get();
        
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
            'descricao' => 'nullable|string'
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }
}
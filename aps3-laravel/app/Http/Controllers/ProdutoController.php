<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index(): View
    {
        $produtos = Produto::with('categoria')->latest()->get();
        $categorias = Categoria::all();
        
        return view('produtos.index', compact('produtos', 'categorias'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Produto::create($validated);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }
}
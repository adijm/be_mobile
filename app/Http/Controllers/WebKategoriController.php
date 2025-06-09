<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class WebKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Category::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BukuWebController extends Controller
{
    public function index(Request $request)
{
    $query = Buku::with('category');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('author', 'like', '%' . $search . '%')
              ->orWhere('isbn', 'like', '%' . $search . '%')
              ->orWhere('publisher', 'like', '%' . $search . '%');
        });
    }

    $bukus = $query->get();

    return view('admin.buku.index', compact('bukus'));
}

    public function create()
    {
        $kategoris = Category::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'isbn' => 'required|string|unique:bukus,isbn',
            'publication_year' => 'required|numeric|min:1900|max:' . date('Y'),
            'stock' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan cover image jika ada
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('cover_buku', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        // Hapus cover image lama jika ada
        if ($buku->cover_image) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Category::all();

        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            // Unique isbn tapi kecuali data buku ini (ignore id saat ini)
            'isbn' => 'required|string|unique:bukus,isbn,' . $buku->id,
            'publication_year' => 'required|numeric|min:1900|max:' . date('Y'),
            'stock' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update field buku
        $buku->title = $validated['title'];
        $buku->author = $validated['author'];
        $buku->publisher = $validated['publisher'];
        $buku->isbn = $validated['isbn'];
        $buku->publication_year = $validated['publication_year'];
        $buku->stock = $validated['stock'];
        $buku->description = $validated['description'];
        $buku->category_id = $validated['category_id'];

        // Jika ada cover baru, hapus lama dan simpan baru
        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $buku->cover_image = $request->file('cover_image')->store('cover_buku', 'public');
        }

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    } 
}

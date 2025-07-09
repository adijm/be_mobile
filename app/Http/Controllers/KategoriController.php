<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //ambil data kategori
        $kategori = Category::all();

        return response()->json([
            'status' => 'success',
            'data' => $kategori

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function BukuKategori($kategori)
    {
        $buku = buku::where('category_id', $kategori)
                    ->with('category')
                    ->paginate(10);

        $buku->getCollection()->transform(function ($book) {
            $book->cover = $book->cover_image;
            $book->cover_url = $book->cover_image
                ? url('storage/cover_buku/' . ltrim($book->cover_image, '/'))
                : null;
            return $book;
        });

        return response()->json([
            'status' => 'success',
            'data' => $buku
        ]);
    } 
}

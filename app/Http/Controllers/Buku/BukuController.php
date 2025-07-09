<?php

namespace App\Http\Controllers\Buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $books = Buku::with('category')->paginate(10);
        $books->getCollection()->each->append('cover_url');

        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'required|string|unique:bukus',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $book = new Buku($request->only([
            'title', 'author', 'publisher', 'isbn', 'publication_year',
            'stock', 'description', 'category_id'
        ]));

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover_buku', $filename);
            $book->cover_image = $filename;
        }

        $book->save();
        $book->append('cover_url');

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    public function show(Buku $book)
    {
        $book->load('category');
        $book->append('cover_url');

        return response()->json([
            'status' => 'success',
            'data' => $book
        ]);
    }

    public function update(Request $request, Buku $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'sometimes|required|string|unique:bukus,isbn,' . $book->id,
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'sometimes|required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $book->fill($request->only([
            'title', 'author', 'publisher', 'isbn',
            'publication_year', 'stock', 'description', 'category_id'
        ]));

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/cover_buku/' . $book->cover_image);
            }
            $image = $request->file('cover_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cover_buku', $filename);
            $book->cover_image = $filename;
        }

        $book->save();
        $book->append('cover_url');

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    public function destroy(Buku $book)
    {
        if ($book->cover_image) {
            Storage::delete('public/cover_buku/' . $book->cover_image);
        }

        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully'
        ]);
    }

    public function bukuTerbaru()
{
    $buku = Buku::orderBy('created_at', 'desc')->take(4)->get();

    $buku->transform(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'author' => $item->author,
            'publisher' => $item->publisher,
            'isbn' => $item->isbn,
            'publication_year' => $item->publication_year,
            'stock' => $item->stock,
            'description' => $item->description,
            'category_id' => $item->category_id,
            'cover_image' => $item->cover_image,
            'cover_url' => $item->cover_url, // akses accessor
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });

    return response()->json([
        'status' => 'success',
        'data' => $buku
    ]);
}

    public function search(Request $request)
    {
        $query = $request->input('query');

        $buku = Buku::where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->with('category')
            ->paginate(10);

        $buku->getCollection()->each->append('cover_url');

        return response()->json([
            'status' => 'success',
            'data' => $buku
        ]);
    }
}
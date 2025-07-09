<?php

namespace App\Http\Controllers\Buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Buku::with('category')->paginate(10);
    
        $books->getCollection()->transform(function ($book) {
            $book->cover = $book->cover_image;
            $book->cover_url = $book->cover_image 
                ? url('storage/' . ltrim($book->cover_image, '/')) 
                : null;
            return $book;
        });
    
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }    

    /**
     * Store a newly created resource in storage.
     */
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

        $book = new Buku();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;
        $book->publication_year = $request->publication_year;
        $book->stock = $request->stock;
        $book->description = $request->description;
        $book->category_id = $request->category_id;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/cover_buku', $filename);
            $book->cover_image = $filename;
        }

        $book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $book)
    {
        $book->load('category');
        $book->cover_url = $book->cover_image ? url('storage/' . $book->cover_image, '/') : null;
        return response()->json([
            'status' => 'success',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

        if ($request->has('title')) $book->title = $request->title;
        if ($request->has('author')) $book->author = $request->author;
        if ($request->has('publisher')) $book->publisher = $request->publisher;
        if ($request->has('isbn')) $book->isbn = $request->isbn;
        if ($request->has('publication_year')) $book->publication_year = $request->publication_year;
        if ($request->has('stock')) $book->stock = $request->stock;
        if ($request->has('description')) $book->description = $request->description;
        if ($request->has('category_id')) $book->category_id = $request->category_id;

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::delete('public/cover_buku/' . $book->cover_image);
            }
            $image = $request->file('cover_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/cover_buku', $filename);
            $book->cover_image = $filename;
        }

        $book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $book)
    {
        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::delete('public/cover_buku/' . $book->cover_image);
        }
        
        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully'
        ]);
    }

    //ambil buku terbaru
    public function bukuTerbaru() {
        $buku = Buku::orderBy('created_at','asc')->take(4)->get();

        $buku->transform(function ($buku) {
            $buku->cover = $buku->cover_image;
            $buku->cover_url = $buku->cover_image? url('storage/'.ltrim($buku->cover_image,'/')):null;
            return $buku;
        });

        return response()->json([
            'status'=>'success',
            'data'=> $buku
        ]);
    }

    // untuk pencarian
    public function search(Request $request) {
        $query = $request->query('query'); //untuk membuat variabel query(inputan user)

        $buku = Buku::where('title', 'like', "%{$query}%")->orWhere('author', 'like', "%{$query}%")->orWhere('isbn','like',"%{$query}%")->with('category')->paginate(10); //paginate (untuk menampilkan maksimal 10)
        $buku->getCollection()->transform(function ($buku) {
            $buku->cover = $buku->cover_image;
            $buku->cover_url = $buku->cover_image? url('storage/'.ltrim($buku->cover_image,'/')):null;
            return $buku;
        });

            return response()->json([
                'status' => 'success',
                'data' => $buku
            ]);
    }



}

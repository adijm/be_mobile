<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category() {

        return $this->belongsTo(Category::class);
        
    }


    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'publication_year',
        'stock',
        'description',
        'category_id',
        'cover_image', 
    ];
    protected $appends = ['cover_url'];
    public function getCoverUrlAttribute()
    {
        return asset('storage/' . ltrim($this->cover_image, '/'));
    }
}

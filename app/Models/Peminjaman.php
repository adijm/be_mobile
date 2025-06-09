<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'peminjaman';

    protected $fillable = [
        'buku_id',
        'user_id',
        'staff_id',
        'tanggal_peminjaman',
        'tenggat_waktu',
        'jumlah',
        'noted',
        'status',
        'tanggal_dikembalikan',
        'selesai',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

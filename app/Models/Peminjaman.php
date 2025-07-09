<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    // Biarkan hanya fillable agar bisa digunakan saat create/update data
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

    /**
     * Relasi ke model Buku (buku yang dipinjam)
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    /**
     * Relasi ke model User (anggota yang meminjam)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model User (petugas/staff yang mengelola)
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

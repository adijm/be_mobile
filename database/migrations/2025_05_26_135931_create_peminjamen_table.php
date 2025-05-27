<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->date('tenggat_waktu');
            $table->integer('jumlah');
            $table->string('noted')->nullable();
            $table->enum('status', [
                'pending',
                'dipinjam',
                'dikembalikan',
                'ditolak',
                'terlambat',
                'kompensasi'
            ])->default('pending');
            $table->date('tanggal_dikembalikan')->nullable();
            $table->bigInteger('selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');

    }
};

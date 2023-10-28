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
        // buat tabel di database
        Schema::create('dosens', function (Blueprint $table) {
            // buat field dalam tabel
            $table->id();
            $table->string('nidn');
            $table->string('nama');
            $table->string('jns_kelamin');
            $table->string('foto');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};

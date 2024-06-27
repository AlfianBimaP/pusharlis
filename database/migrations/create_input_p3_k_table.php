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
        Schema::create('input_p3k', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kotak_id')->constrained('kotaks')->onDelete('cascade');
            $table->foreignId('data_p3ks_id')->constrained('data_p3ks')->onDelete('cascade');
            $table->integer('quantity');
            $table->string('keperluan');
            $table->date('tanggal');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_p3k');
    }
};

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
        Schema::create('data_kotak', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kotak_id')->constrained('kotaks');
            $table->foreignId('data_p3ks_id')->constrained('data_p3ks');
            $table->integer('quantity');
            $table->date('exp_date');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kotak');
    }
};

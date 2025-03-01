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
        Schema::create('api_list', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id')->length(11)->nullable();
            $table->text('nama')->nullable();
            $table->text('ket_nama')->nullable();
            $table->string('method', '10')->nullable();
            $table->text('url')->nullable();
            $table->string('struktural', '30')->nullable();
            $table->string('permintaan', '30')->nullable();
            $table->text('inputan')->nullable();
            $table->text('hasil')->nullable();
            $table->integer('deleted')->length(1)->default(0)->nullable();
            $table->integer('created_by')->length(11)->nullable();
            $table->integer('updated_by')->length(11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_list');
    }
};

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
        Schema::create('doc_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('menu_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('deleted', ['0', '1'])->default('0');
            $table->timestamps();

            $table->unique('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_menu');
    }
};

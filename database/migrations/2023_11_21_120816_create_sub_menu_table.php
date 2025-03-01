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
        Schema::create('sub_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_id')->length(11)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('uri', 100)->nullable()->unique();
            $table->string('level_id', 100)->nullable();
            $table->integer('deleted')->length(1)->nullable();
            $table->integer('created_by')->length(11)->nullable();
            $table->string('created_username', 100)->nullable();
            $table->integer('updated_by')->length(11)->nullable();
            $table->string('updated_username', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menu');
    }
};

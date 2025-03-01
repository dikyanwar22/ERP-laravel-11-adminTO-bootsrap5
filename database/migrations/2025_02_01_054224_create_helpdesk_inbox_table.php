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
        Schema::create('helpdesk_inbox', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usergrp_id_receiver')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable(); 
            $table->string('url', 255)->nullable();
            $table->unsignedBigInteger('user_id_sender')->nullable(); 
            $table->string('file_upload', 255)->nullable(); 
            $table->text('message')->nullable(); 
            $table->unsignedBigInteger('user_id_receiver')->nullable(); 
            $table->text('reply_message')->nullable(); 
            $table->enum('status', ['0', '1', '2'])->default('0'); 
            $table->timestamps(); 
            $table->timestamp('reply_at')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesk_inbox');
    }
};

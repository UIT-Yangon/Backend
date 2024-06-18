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
        Schema::create('sub__news', function (Blueprint $table) {
            $table->id();
            $table->String('sub_title')->nullable();
            $table->text('sub_body')->nullable();
            $table->string('image')->nullable();
            $table->integer('postId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub__news');
    }
};

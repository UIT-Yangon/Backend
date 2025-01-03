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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('paperCall');
            $table->date('updated_deadline')->nullable();
            $table->date('original_deadline')->nullable();
            $table->string('status');
            $table->string('ieee_link')->nullable(true);
            $table->date('accept_noti')->nullable();
            $table->string('email');
            $table->string('book')->nullable();
            $table->string('brochure')->nullable();
            $table->bigInteger('local_fee');
            $table->bigInteger('foreign_fee');
            $table->date('conference_date')->nullable();
            $table->string('paper_format');
            $table->json('topics')->nullable(true);
            $table->date('camera_ready')->nullable();
            $table->longText('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};

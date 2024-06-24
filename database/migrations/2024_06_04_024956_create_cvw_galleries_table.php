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
        Schema::create('cvw_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cvw_id')->index()->constrained();
            $table->foreignId('location_id')->index()->constrained();
            $table->text('gallery_image');
            $table->string('gallery_desc');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvw_galleries');
    }
};

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
        Schema::create('pmsc_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pmsc_id')->index()->constrained();
            $table->text('gallery_image');
            $table->string('gallery_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('pmsc_galleries');
    }
};

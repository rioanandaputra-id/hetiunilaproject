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
        Schema::create('pmscs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index()->constrained();
            $table->foreignId('timeline_id')->index()->constrained();
            $table->datetime('pmsc_date');
            $table->string('pmsc_location');
            $table->string('pmsc_agenda');
            $table->string('pmsc_agenda_en');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmscs');
    }
};

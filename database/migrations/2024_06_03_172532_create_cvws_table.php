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
        Schema::create('cvws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index()->constrained();
            $table->foreignId('location_id')->index()->constrained();
            $table->foreignId('timeline_id')->index()->constrained();
            $table->decimal('cvw_plan', 10, 2)->default(0.00);
            $table->decimal('cvw_plan_cumulative', 10, 2)->default(0.00);
            $table->decimal('cvw_real', 10, 2)->default(0.00);
            $table->decimal('cvw_real_cumulative', 10, 2)->default(0.00);
            $table->decimal('cvw_deviasi', 10, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvws');
    }
};

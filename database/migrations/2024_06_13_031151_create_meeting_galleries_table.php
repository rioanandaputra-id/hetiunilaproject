<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('meeting_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->index()->constrained();
            $table->text('gallery_image');
            $table->string('gallery_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_galleries');
    }
}

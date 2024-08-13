<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessedMusicsTable extends Migration
{
    public function up()
    {
        Schema::create('processed_musics', function (Blueprint $table) {
            $table->id();
            $table->string('original_filename');
            $table->string('processed_filename');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processed_musics');
    }
}

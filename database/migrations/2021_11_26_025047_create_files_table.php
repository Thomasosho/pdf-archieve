<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('class')->nullable();
            $table->string('date')->nullable();
            $table->string('account')->nullable();
            $table->string('person')->nullable();
            $table->text('keywords')->nullable();
            $table->longText('description')->nullable();
            $table->string('orig_filename', 100)->nullable();
            $table->string('mime_type', 50)->nullable();
            $table->bigInteger('filesize')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}

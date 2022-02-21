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
            $table->string('file')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('reference')->nullable();
            $table->string('category_id')->nullable();
            $table->string('folder')->nullable();
            $table->text('extension')->nullable();
            $table->longText('description')->nullable();
            $table->string('orig_filename', 1000)->nullable();
            $table->string('mime_type', 1000)->nullable();
            $table->bigInteger('filesize')->nullable();
            $table->text('content')->nullable();
            $table->string('opendate')->nullable();
            $table->string('closedate')->nullable();
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

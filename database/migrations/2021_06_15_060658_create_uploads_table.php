<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_by');
            $table->unsignedBigInteger('import_by')->nullable();
            $table->string('file_name')->unique();
            $table->string('orig_file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->string('new_file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('full_storage_path')->nullable();
            $table->timestamp('date_modified')->nullable();
            $table->integer('record_count')->nullable();
            $table->integer('record_error_count')->nullable();
            $table->integer('record_empty_cells')->nullable();
            $table->string('category')->nullable();
            $table->boolean('show')->default(true);
            $table->bigInteger('size')->nullable(); //in bytes
            $table->timestamp('import_start')->nullable();
            $table->timestamp('import_end')->nullable();
            $table->timestamps();

            $table->foreign('upload_by')->references('id')->on('users');
            $table->foreign('import_by')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE uploads ADD blob_file MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}

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
            $table->string('file_name')->unique();
            $table->string('orig_file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->string('new_file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('full_storage_path')->nullable();
            $table->timestamp('date_modified')->nullable();
            $table->bigInteger('record_count')->nullable();
            $table->bigInteger('record_error_count')->nullable();
            $table->string('category')->nullable();
            $table->boolean('show')->default(true);
            $table->bigInteger('size')->nullable(); //in bytes
            $table->timestamp('import_start')->nullable();
            $table->timestamp('import_end')->nullable();
            $table->timestamps();
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

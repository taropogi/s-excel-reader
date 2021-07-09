<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('customer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upload_id')->constrained()->onDelete('cascade');
            $table->string('sheet_name')->nullable();
            $table->integer('line_number')->nullable();
            $table->string('commodity_code')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->string('oracle_code')->nullable();
            $table->string('rank')->nullable();
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
        Schema::dropIfExists('customer_items');
    }
}

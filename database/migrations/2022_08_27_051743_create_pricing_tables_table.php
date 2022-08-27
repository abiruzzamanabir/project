<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('memory');
            $table->string('memory_type');
            $table->string('processor');
            $table->string('disk');
            $table->string('transfer');
            $table->string('link');
            $table->boolean('status')->default(true);
            $table->boolean('trash')->default(false);
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
        Schema::dropIfExists('pricing_tables');
    }
};

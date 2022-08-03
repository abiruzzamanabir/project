<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id')->default(3);
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('cell')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->text('dob')->nullable();
            $table->string('photo')->default('avatar.png');
            $table->string('access_token')->nullable();
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
        Schema::dropIfExists('admins');
    }
};

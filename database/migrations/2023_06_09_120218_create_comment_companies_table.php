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
        Schema::create('comment_companies', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('name');
            $table->text('discription')->nullable();
            $table->string('star')->nullable();
            $table->boolean('ok')->default(0);
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
        Schema::dropIfExists('comment_companies');
    }
};

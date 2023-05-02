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
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('category', 1)->nullable(false);
            $table->bigInteger('parentid')->default(0);
            $table->integer('sortorder')->default(0);
            $table->string('name', 20)->nullable(false);
            $table->string('description', 50);
            $table->string('lastchangeby', 3)->nullable();
            $table->timestamp('lastchangedate', 0)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('listings');
    }
};

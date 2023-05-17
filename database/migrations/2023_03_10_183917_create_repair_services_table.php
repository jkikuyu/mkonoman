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
        Schema::create('repair_services', function (Blueprint $table) {
            $table->id();
            $table->char('category', 1)->nullable(false);
            $table->bigInteger('parentid')->default(0);
            $table->integer('sortorder')->default(0);
            $table->string('name', 20)->nullable(false);
            $table->string('description', 50);
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
        Schema::dropIfExists('repair_services');
    }
};

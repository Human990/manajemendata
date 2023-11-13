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
        Schema::create('sub_opds', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sub_opd')->nullable();
            $table->string('nama_sub_opd')->nullable();
            $table->string('level')->nullable();
            $table->unsignedBigInteger('tahun_id')->nullable(true);
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
        Schema::dropIfExists('sub_opds');
    }
};

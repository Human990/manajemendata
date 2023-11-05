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
        Schema::create('catatan_opds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id')->nullable(true);
            $table->text('catatan_opd')->nullable(true);
            $table->text('catatan_admin')->nullable(true);
            $table->string('status')->nullable(true);
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
        Schema::dropIfExists('catatan_opds');
    }
};

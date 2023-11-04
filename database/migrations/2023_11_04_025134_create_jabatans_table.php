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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->string('jenis_jabatan')->nullable();
            $table->string('kelas_jabatan')->nullable();
            $table->string('nilai_jabatan')->nullable();
            $table->string('index')->nullable();
            $table->string('tunjab')->nullable();
            $table->string('tahun');
            $table->unsignedBigInteger('tahun_id')->nullable(true);
            $table->unsignedBigInteger('indeks_id')->nullable(true);
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
        Schema::dropIfExists('jabatans');
    }
};

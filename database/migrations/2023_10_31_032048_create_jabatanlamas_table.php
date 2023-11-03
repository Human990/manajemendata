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
        Schema::create('jabatanlama', function (Blueprint $table) {
            $table->bigIncrements('kode_jabatanlama');
            $table->string('nama_jabatan');
            $table->string('jenis_jabatan')->nullable();
            $table->string('kelas_jabatan')->nullable();
            $table->string('nilai_jabatan')->nullable();
            $table->string('index')->nullable();
            $table->string('tunjab')->default('185000');
            $table->string('tahun');
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
        Schema::dropIfExists('jabatanlamas');
    }
};

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
        Schema::create('pegawai_bulanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_opd');
            $table->string('ukor_eselon2')->nullable();
            $table->string('ukor_eselon3')->nullable();
            $table->string('ukor_eselon4')->nullable();
            $table->unsignedBigInteger('kode_jabatanlama');
            $table->unsignedBigInteger('kode_jabatanbaru');
            $table->foreign('kode_jabatanlama')->references('kode_jabatanlama')->on('jabatanlama');
            $table->foreign('kode_jabatanbaru')->references('kode_jabatanbaru')->on('jabatanbaru');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('sts_pegawai');
            $table->string('sts_jabatan');
            $table->string('pangkat');
            $table->string('eselon');
            $table->string('jv');
            $table->string('indeks');
            $table->string('tpp');
            $table->string('sertifikasi_guru')->nullable();
            $table->string('pa_kpa')->nullable();
            $table->string('pbj')->nullable();
            $table->string('jft');
            $table->string('subkoor')->nullable();
            $table->string('nama_subkoor')->nullable();
            $table->string('sts_subkoor')->nullable();
            $table->string('atasan_nip')->nullable();
            $table->string('atasan_nama')->nullable();
            $table->string('atasannya_atasan_nip')->nullable();
            $table->string('atasannya_atasan_nama')->nullable();
            $table->string('bulan')->default(1);
            $table->string('tahun')->nullable();
            $table->string('pensiun')->nullable();
            $table->string('tpp_tambahan')->nullable();
            $table->string('jumlah_pemangku')->default(1);
            $table->string('basic_tpp')->nullable();
            $table->string('jenis_evidence_bk')->nullable();
            $table->string('jenis_evidence_pk')->nullable();
            $table->string('jenis_evidence_kk')->nullable();
            $table->string('jenis_evidence_tb')->nullable();
            $table->string('jenis_evidence_kp')->nullable();
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
        Schema::dropIfExists('pegawai_bulanan');
    }
};

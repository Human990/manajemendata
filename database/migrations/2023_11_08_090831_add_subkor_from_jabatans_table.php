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
        Schema::table('jabatans', function (Blueprint $table) {
            $table->unsignedBigInteger('indeks_subkor_penyetaraan_id')->nullable(true);
            $table->unsignedBigInteger('indeks_subkor_non_penyetaraan_id')->nullable(true);
            $table->unsignedBigInteger('nilai_jabatan_subkor_penyetaraan')->nullable(true);
            $table->unsignedBigInteger('nilai_jabatan_subkor_non_penyetaraan')->nullable(true);
            $table->integer('prosentase_penerimaan_murni')->nullable(true);
            $table->integer('prosentase_penerimaan_subkor_penyetaraan')->nullable(true);
            $table->integer('prosentase_penerimaan_subkor_non_penyetaraan')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->dropColumn('indeks_subkor_penyetaraan_id');
            $table->dropColumn('indeks_subkor_non_penyetaraan_id');
            $table->dropColumn('nilai_jabatan_subkor_penyetaraan');
            $table->dropColumn('nilai_jabatan_subkor_non_penyetaraan');
            $table->dropColumn('prosentase_penerimaan_murni');
            $table->dropColumn('prosentase_penerimaan_subkor_penyetaraan');
            $table->dropColumn('prosentase_penerimaan_subkor_non_penyetaraan');
        });
    }
};

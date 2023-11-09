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
            $table->unsignedBigInteger('indeks_koor_penyetaraan_id')->nullable(true);
            $table->unsignedBigInteger('indeks_koor_non_penyetaraan_id')->nullable(true);
            $table->unsignedBigInteger('nilai_jabatan_koor_penyetaraan')->nullable(true);
            $table->unsignedBigInteger('nilai_jabatan_koor_non_penyetaraan')->nullable(true);
            $table->integer('prosentase_penerimaan_koor_penyetaraan')->nullable(true);
            $table->integer('prosentase_penerimaan_koor_non_penyetaraan')->nullable(true);
            $table->string('tunjab_subkor')->nullable();
            $table->string('tunjab_koor')->nullable();
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
            $table->dropColumn('indeks_koor_penyetaraan_id');
            $table->dropColumn('indeks_koor_non_penyetaraan_id');
            $table->dropColumn('nilai_jabatan_koor_penyetaraan');
            $table->dropColumn('nilai_jabatan_koor_non_penyetaraan');
            $table->dropColumn('prosentase_penerimaan_koor_penyetaraan');
            $table->dropColumn('prosentase_penerimaan_koor_non_penyetaraan');
            $table->dropColumn('tunjab_subkor');
            $table->dropColumn('tunjab_koor');
        });
    }
};

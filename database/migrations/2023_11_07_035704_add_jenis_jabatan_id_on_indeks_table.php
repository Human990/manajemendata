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
        Schema::table('indeks', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_jabatan_id')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indeks', function (Blueprint $table) {
            $table->dropColumn('jenis_jabatan_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAjaranSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_ajaran_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tahun_ajaran_id');
            $table->integer('bulan1');
            $table->integer('bulan2');
            $table->integer('bulan3');
            $table->integer('bulan4');
            $table->integer('bulan5');
            $table->integer('bulan6');
            $table->integer('bulan7');
            $table->integer('bulan8');
            $table->integer('bulan9');
            $table->integer('bulan10');
            $table->integer('bulan11');
            $table->integer('bulan12');
            $table->enum('is_permanent', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_ajaran_setting');
    }
}

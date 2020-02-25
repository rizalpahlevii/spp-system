<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->date('tgl_bayar');
            $table->char('bulan_bayar')->comment('value ini sesuai dengan bulan dimana dimulainya tahun ajaran baru / Sesuai setting tahun ajaran. Contoh bulan dimulainya dari juli. value juli = 1, agustus = 2');
            $table->char('tahun_bayar');
            $table->unsignedBigInteger('spp_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('master_kelas_id');
            $table->integer('jumlah_bayar');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('spp_id')->references('id')->on('spp')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->foreign('master_kelas_id')->references('id')->on('master_kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}

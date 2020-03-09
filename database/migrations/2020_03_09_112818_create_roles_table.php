<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uri');
            $table->string('route');
            $table->string('title');
            $table->string('icon');
            $table->enum('is_active', ['yes', 'no']);
            $table->timestamps();
        });
        DB::table('roles')->insert([
            [
                'uri' => '/',
                'route' => 'dashboard',
                'title' => 'Dashboard',
                'icon' => 'fa fa-fw fa-user-circle',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uri' => '/tahun-ajaran',
                'route' => 'ta',
                'title' => 'Tahun Ajaran',
                'icon' => 'fa fa-fw fa-calendar-alt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uri' => '/kelas',
                'route' => 'kelas',
                'title' => 'Kelas',
                'icon' => 'fa fa-fw fa-warehouse',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uri' => '/siswa',
                'route' => 'siswa',
                'title' => 'Siswa',
                'icon' => 'fas fa-fw fa-graduation-cap',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uri' => '/spp',
                'route' => 'spp',
                'title' => 'SPP',
                'icon' => 'fa fa-fw fa-money-bill-alt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uri' => '/petugas',
                'route' => 'petugas',
                'title' => 'Petugas',
                'icon' => 'fa fa-fw fa-users',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uri' => '/pembayaran',
                'route' => 'pembayaran',
                'title' => 'Pembayaran SPP',
                'icon' => 'fas fa-fw fa-list',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

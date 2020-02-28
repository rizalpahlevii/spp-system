<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('level_id')->references('id')->on('level')->onDelete('cascade');
        });
        $admin = DB::table('level')->where('nama', 'Admin')->first();
        $petugas = DB::table('level')->where('nama', 'Petugas')->first();
        DB::table('users')->insert([[
            'name' => 'Muhammad Rizal Pahlevi',
            'email' => 'mrizalpahlevi372@gmail.com',
            'username' => 'rizalpahlevi',
            'password' => Hash::make(12345678),
            'level_id' => $admin->id,
            'created_at' => Carbon::now()
        ], [
            'name' => 'Petugas SPP',
            'email' => 'petugas@gmail.com',
            'username' => 'petugas',
            'password' => Hash::make(12345678),
            'level' => $petugas->id,
            'created_at' => Carbon::now()
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

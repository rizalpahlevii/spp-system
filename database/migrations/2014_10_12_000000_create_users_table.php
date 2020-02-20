<?php

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
            $table->enum('level', ['Admin', 'Petugas']);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('users')->insert([[
            'name' => 'Muhammad Rizal Pahlevi',
            'email' => 'mrizalpahlevi372@gmail.com',
            'username' => 'rizalpahlevi',
            'password' => Hash::make(12345678),
            'level' => 'Admin'
        ], [
            'name' => 'Petugas SPP',
            'email' => 'petugas@gmail.com',
            'username' => 'petugas',
            'password' => Hash::make(12345678),
            'level' => 'Petugas'
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

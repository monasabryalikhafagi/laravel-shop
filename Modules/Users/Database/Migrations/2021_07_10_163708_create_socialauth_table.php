<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialauthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socialauth', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            Schema::create('socialauth', function(Blueprint $table) {
                $table->engine = 'InnoDB';
    
                $table->increments('id');
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('provider');//=> [Facebook || Twitter || LinkedIn || Google || GitHub || Bitbucket]
                $table->string('auth_id');
                $table->text('token')->nullable();
                $table->text('refresh_token')->nullable();
                $table->string('avatar')->nullable();
                $table->timestamps();
            });
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('socialauth', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            Schema::drop('socialauth');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }
}

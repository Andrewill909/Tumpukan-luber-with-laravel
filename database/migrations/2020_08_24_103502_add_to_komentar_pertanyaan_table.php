<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToKomentarPertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komentar_pertanyaan', function (Blueprint $table) {
            $table->unsignedBigInteger('pertanyaan_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('komentar_pertanyaan', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['pertanyaan_id']);

            $table->dropColumn(['user_id']);
            $table->dropColumn(['pertanyaan_id']);
        });
    }
}

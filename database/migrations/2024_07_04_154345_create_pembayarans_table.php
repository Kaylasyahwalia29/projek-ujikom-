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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->foreignId('id_keranjang')->onDelete('cascade');
            $table->foreignId('id_method')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
        $table->id();
        $table->foreignId('id_keranjang')->onDelete('cascade');
        $table->foreignId('id_method')->onDelete('cascade');
    }
};

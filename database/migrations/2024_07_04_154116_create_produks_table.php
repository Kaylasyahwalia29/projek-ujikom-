<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name_produk');
            $table->text('desc_produk');
            $table->integer('harga_produk');
            $table->integer('stok_produk');
            $table->string('image_produk')->nullable();
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
};

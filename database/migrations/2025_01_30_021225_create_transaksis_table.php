
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengguna');
            $table->string('nama_produk', 100);
            $table->integer('total_harga');
            $table->date('tanggal_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pembayaran');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pembayaran')->references('id')->on('pembayarans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};

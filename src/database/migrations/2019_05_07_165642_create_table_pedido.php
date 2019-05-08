<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numpedido')->unique();
            $table->integer('idcliente')->unsigned();
            $table->integer('idticket')->unsigned();
            $table->timestamps();

            $table->foreign('idcliente', 'FK_pedido_cliente')->references('id')->on('cliente');
            $table->foreign('idticket', 'FK_pedido_ticket')->references('id')->on('ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}

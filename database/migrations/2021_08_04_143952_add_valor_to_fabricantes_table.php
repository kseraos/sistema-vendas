<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorToFabricantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabricantes', function (Blueprint $table) {
            $table->decimal('valor_pedido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fabricantes', function (Blueprint $table) {
            $table->dropColumn('valor_pedido');
        });
    }
}

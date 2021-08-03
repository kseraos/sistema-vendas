<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


Class RenameFabricantesColumn extends Migration
{

    public function up()
    {
        Schema::table('fabricantes', function(Blueprint $table) {
            $table->renameColumn('birth_date', 'data_do_pedido');
        });
    }


    public function down()
    {
        Schema::table('fabricantes', function(Blueprint $table) {
            $table->renameColumn('data_do_pedido', 'birth_date');
        });
    }

}







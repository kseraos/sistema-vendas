<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToFabricantesTable extends Migration
{
  
    public function up()
    {
        Schema::table('fabricantes', function (Blueprint $table) {
            
            $table->string('birth_date');
            Schema::rename($birth_date, $pedido);

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
            
            Schema::dropIfExists('fabricantes');
        });
    }


    
}

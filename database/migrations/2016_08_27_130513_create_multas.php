<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multas', function(Illuminate\Database\Schema\Blueprint $table){
          $table->increments('id');

          $table->string('folio');
          $table->string('placa');
          $table->string('importe');
          $table->string('redondeo');

          $table->text('multas_html');

          $table->text('html');
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
        Schema::drop('multas');
    }
}

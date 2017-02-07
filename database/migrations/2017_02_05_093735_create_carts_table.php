<?php 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            //$table->increments('id');
                        $table->increments('id');
            $table->integer('users_id');
            $table->integer('products_id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('carts');
    }
}

?>
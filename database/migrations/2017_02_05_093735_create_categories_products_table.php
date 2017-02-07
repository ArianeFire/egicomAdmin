<?php 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategories_productsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('categories_products', function (Blueprint $table) {
            //$table->increments('id');
                        $table->increments('id');
            $table->integer('products_id');
            $table->integer('categories_id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('categories_products');
    }
}

?>
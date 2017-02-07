<?php 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //$table->increments('id');
                        $table->increments('id');
            $table->string('name', 50);
            $table->boolean('availability');
            $table->integer('warranty');
            $table->string('transport', 50);
            $table->boolean('hasTVA');
            $table->string('description', 50);
            $table->float('normalPrice', 3, 4);
            $table->float('promoPrice', 3, 4);
            $table->string('bigImageUrl');
            $table->string('smallImageUrl');
            $table->integer('category_id');
            $table->integer('manifacturer_id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('products');
    }
}

?>
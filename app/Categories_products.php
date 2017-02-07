<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Categories_products extends Model
{
    protected $primaryKey = "id";

    protected $table = "categories_products";

    protected $fillable = ["id", "products_id", "categories_id",  ];

     

       
 


    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    /**
    * The storage format of the model's date columns.
    *
    * @var  string
    */
    //protected $dateFormat = 'Y-m-d'; //H:i:s

    /**
    * The attributes that should be mutated to dates.
    *
    * @var  array
    */
    //protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}

?>
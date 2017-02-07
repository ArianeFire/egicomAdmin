<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Carts extends Model
{
    protected $primaryKey = "id";

    protected $table = "carts";

    protected $fillable = ["id", "users_id", "products_id",  ];

    function users(){ 
        return $this->belongsTo('App\Users');
    }

 

       
    
 


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
<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Categories extends Model
{
    protected $primaryKey = "id";

    protected $table = "categories";

    protected $fillable = ["id", "name",  ];

    function products(){ 
        return $this->belongsToMany('App\Products');
    }

 

    function getNameAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }  
    function getProductsPaginatedAttribute(){
        $products = $this->products();
    if(session("keyword", "none") != "none"){
        $key = "%".session('keyword','')."%";
        $products->where('name', 'like', $key)
              ->orWhere('availability', 'like', $key)
             ->orWhere('warranty', 'like', $key)
             ->orWhere('transport', 'like', $key)
             ->orWhere('hasTVA', 'like', $key)
             ->orWhere('description', 'like', $key)
             ->orWhere('normalPrice', 'like', $key)
             ->orWhere('promoPrice', 'like', $key)
             ->orWhere('bigImageUrl', 'like', $key)
             ->orWhere('smallImageUrl', 'like', $key)
             ->orWhere('category_id', 'like', $key)
             ->orWhere('manifacturer_id', 'like', $key)
           ;
}

        if(session("sortKey", "none") == "none" or !Schema::hasColumn("products", session("sortKey", "none")))
            return $products->paginate(20)->appends(array("tab" => "products"));

        return $products->orderBy(session("sortKey", "name"), session("sortOrder", "asc"))->paginate(20)->appends(array("tab" => "products"));

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
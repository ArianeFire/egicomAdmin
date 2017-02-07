<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Products extends Model
{
    protected $primaryKey = "id";

    protected $table = "products";

    protected $fillable = ["id", "name", "availability", "warranty", "transport", "hasTVA", "description", "normalPrice", "promoPrice", "bigImageUrl", "smallImageUrl", "category_id", "manifacturer_id",  ];

    function manifacturers(){ 
        return $this->belongsTo('App\Manifacturers');
    }

function categories(){ 
        return $this->belongsToMany('App\Categories');
    }

 

    function getNameAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }   function getTransportAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }  function getDescriptionAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }   function getBigImageUrlAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    } function getSmallImageUrlAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }    
    
    function getCategoriesPaginatedAttribute(){
        $categories = $this->categories();
    if(session("keyword", "none") != "none"){
        $key = "%".session('keyword','')."%";
        $categories->where('name', 'like', $key)
            ;
}

        if(session("sortKey", "none") == "none" or !Schema::hasColumn("categories", session("sortKey", "none")))
            return $categories->paginate(20)->appends(array("tab" => "categories"));

        return $categories->orderBy(session("sortKey", "name"), session("sortOrder", "asc"))->paginate(20)->appends(array("tab" => "categories"));

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
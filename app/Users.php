<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Users extends Model
{
    protected $primaryKey = "id";

    protected $table = "users";

    protected $fillable = ["id", "name", "email", "password",  ];

    function carts(){ 
        return $this->hasMany('App\Carts');
    }

 

    function getNameAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    } function getEmailAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."....";
        }

        return $value;
    } function getPasswordAttribute($value){

        if(strlen($value) > 40 && session('mutate', 'none') == '1') {
            return substr($value, 0, 40)."...";
        }

        return $value;
    }  
    function getCartsPaginatedAttribute(){
        $carts = $this->carts();
    if(session("keyword", "none") != "none"){
        $key = "%".session('keyword','')."%";
        $carts->where('id', 'like', $key)
             ->orWhere('users_id', 'like', $key)
             ->orWhere('products_id', 'like', $key)
           ;
}

        if(session("sortKey", "none") == "none" or !Schema::hasColumn("carts", session("sortKey", "none")))
            return $carts->paginate(20)->appends(array("tab" => "carts"));

        return $carts->orderBy(session("sortKey", "id"), session("sortOrder", "asc"))->paginate(20)->appends(array("tab" => "carts"));

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
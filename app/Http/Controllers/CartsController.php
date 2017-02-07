<?php 
namespace App\Http\Controllers;

use App\Carts;
    use App\Users;

     
class CartsController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return  Response
    */
    public function index()
    {
        request()->session()->forget("keyword");
        request()->session()->forget("clear");
        request()->session()->forget("defaultSelect");
        session(["mutate" => '1']);


        return view('carts_show', ['cartss' => Carts::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('carts');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $carts = Carts::create([
             "users_id" => $data["users_id"],
             "products_id" => $data["products_id"],
         ]);

            if(request()->exists('users')){
            $users = Users::find(request()->get('users'));
            $carts->users()->associate($users)->save();
        }
      
        return redirect('/carts');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Carts $carts )
    {
        request()->session()->forget("mutate");
        $carts->load(array("users",));
        return view('carts_display', compact('carts'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Carts $carts )
    {
        request()->session()->forget("mutate");
        $carts->load(array("users",));
        return view('carts_edit', compact('carts'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Carts $carts )
    {
            $carts->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Carts $carts )
    {
            $carts->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Carts $carts ){

        session(["mutate" => '1']);
        if(request()->exists('cs')){
            request()->session()->forget("keyword");
            return back();
        }

        if(request()->exists('tab') && session("clear", "none") != request()->get('tab')){
            request()->session()->forget("keyword");
            session(["clear" => request()->get('tab')]);
        }

        $table = request()->get('tab');
        $carts->load(array("users",));
return view('carts_related', compact(['carts', 'table']));
    }

    /**
    * Search Table element By keyword
    * @return  Response
    */
    public function search(){
        $keyword = request()->get('keyword');

        if(request()->exists('tab')){
            session(['keyword' => $keyword]);
            return back();
        }

        session(["keyword" => $keyword]);

        $keyword = '%'.$keyword.'%';

        $cartss = Carts::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('users_id', 'like', $keyword)

         ->orWhere('products_id', 'like', $keyword)

        ->paginate(20);
    $cartss->setPath("search?keyword=$keyword");
    return view('carts_show', compact('cartss'));
    }

    /**
    * Sort Table element
    * @return  Response
    */
    public function sort(){
        $path = "";

            request()->session()->forget("sortKey");
    request()->session()->forget("sortOrder");
    if(!request()->exists('tab')){
$cartss = Carts::query();
         if(request()->exists('users_id')){
            $cartss = $cartss->orderBy('users_id', $this->getOrder('users_id'));
            $path = "users_id";
        }else{
            request()->session()->forget("users_id");
        }
         if(request()->exists('products_id')){
            $cartss = $cartss->orderBy('products_id', $this->getOrder('products_id'));
            $path = "products_id";
        }else{
            request()->session()->forget("products_id");
        }
         $cartss = $cartss->paginate(20);
        $cartss->setPath("sort?$path");
        return view('carts_show', compact('cartss'));

    }else{

    if(request()->exists('tab') == 'users'){

                 if(request()->exists('name')){
             session(['sortOrder' => $this->getOrder('name')]);
             session(['sortKey' => 'name']);
        }else{
            request()->session()->forget("name");
        }

                 if(request()->exists('email')){
             session(['sortOrder' => $this->getOrder('email')]);
             session(['sortKey' => 'email']);
        }else{
            request()->session()->forget("email");
        }

                 if(request()->exists('password')){
             session(['sortOrder' => $this->getOrder('password')]);
             session(['sortKey' => 'password']);
        }else{
            request()->session()->forget("password");
        }

                 }
             return back();
    }
    }

    /**
    * Clear Search Pattern
    *
    */
    public function clearSearch(){
        request()->session()->forget("keyword");
        return back();
    }



    function updateUsers(Carts $carts ){
    $users = \App\Users::find(request()->get('users'));
    $carts->users()->associate($users)->save();
    return back();
}
 
    private function getOrder($param){
        if(session($param, "none") != "none"){
            session([$param => session($param, 'asc') == 'asc' ? 'desc':'asc']);
        }else{
            session([$param => 'asc']);
        }
        return session($param);
    }



}


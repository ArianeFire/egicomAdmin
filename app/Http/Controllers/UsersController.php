<?php 
namespace App\Http\Controllers;

use App\Users;
    use App\Carts;

     
class UsersController extends Controller {

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


        return view('users_show', ['userss' => Users::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('users');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $users = Users::create([
             "name" => $data["name"],
             "email" => $data["email"],
             "password" => $data["password"],
         ]);

      
        return redirect('/users');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Users $users )
    {
        request()->session()->forget("mutate");
        $users->load(array("carts",));
        return view('users_display', compact('users'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Users $users )
    {
        request()->session()->forget("mutate");
        $users->load(array("carts",));
        return view('users_edit', compact('users'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Users $users )
    {
            $users->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Users $users )
    {
            $users->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Users $users ){

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
        $users->load(array("carts",));
return view('users_related', compact(['users', 'table']));
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

        $userss = Users::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

         ->orWhere('email', 'like', $keyword)

         ->orWhere('password', 'like', $keyword)

        ->paginate(20);
    $userss->setPath("search?keyword=$keyword");
    return view('users_show', compact('userss'));
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
$userss = Users::query();
         if(request()->exists('name')){
            $userss = $userss->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
         if(request()->exists('email')){
            $userss = $userss->orderBy('email', $this->getOrder('email'));
            $path = "email";
        }else{
            request()->session()->forget("email");
        }
         if(request()->exists('password')){
            $userss = $userss->orderBy('password', $this->getOrder('password'));
            $path = "password";
        }else{
            request()->session()->forget("password");
        }
         $userss = $userss->paginate(20);
        $userss->setPath("sort?$path");
        return view('users_show', compact('userss'));

    }else{

    if(request()->exists('tab') == 'carts'){

                 if(request()->exists('user_id')){
             session(['sortOrder' => $this->getOrder('user_id')]);
             session(['sortKey' => 'user_id']);
        }else{
            request()->session()->forget("user_id");
        }

                 if(request()->exists('product_id')){
             session(['sortOrder' => $this->getOrder('product_id')]);
             session(['sortKey' => 'product_id']);
        }else{
            request()->session()->forget("product_id");
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



    function addCarts(Users $users ){
    $users->carts()->sync(request()->get('carts'));
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


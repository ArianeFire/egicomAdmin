<?php 
namespace App\Http\Controllers;

use App\User;
    use App\Carts;

     
class UserController extends Controller {

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


        return view('user_show', ['users' => User::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('user');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $user = User::create([
             "name" => $data["name"],
             "email" => $data["email"],
             "password" => $data["password"],
         ]);

      
        return redirect('/user');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(User $user )
    {
        request()->session()->forget("mutate");
        $user->load(array("carts",));
        return view('user_display', compact('user'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(User $user )
    {
        request()->session()->forget("mutate");
        $user->load(array("carts",));
        return view('user_edit', compact('user'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(User $user )
    {
            $user->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(User $user )
    {
            $user->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(User $user ){

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
        $user->load(array("carts",));
return view('user_related', compact(['user', 'table']));
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

        $users = User::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

         ->orWhere('email', 'like', $keyword)

         ->orWhere('password', 'like', $keyword)

        ->paginate(20);
    $users->setPath("search?keyword=$keyword");
    return view('user_show', compact('users'));
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
$users = User::query();
         if(request()->exists('name')){
            $users = $users->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
         if(request()->exists('email')){
            $users = $users->orderBy('email', $this->getOrder('email'));
            $path = "email";
        }else{
            request()->session()->forget("email");
        }
         if(request()->exists('password')){
            $users = $users->orderBy('password', $this->getOrder('password'));
            $path = "password";
        }else{
            request()->session()->forget("password");
        }
         $users = $users->paginate(20);
        $users->setPath("sort?$path");
        return view('user_show', compact('users'));

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



    function addCarts(User $user ){
    $user->carts()->sync(request()->get('carts'));
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


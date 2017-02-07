<?php 
namespace App\Http\Controllers;

use App\Category;
    use App\Film;

     
class CategoryController extends Controller {

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


        return view('category_show', ['categorys' => Category::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('category');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $category = Category::create([
             "name" => $data["name"],
          ]);

            if(request()->exists('film')){
        $category->film()->attach($data["film"]);
        }
      
        return redirect('/category');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Category $category )
    {
        request()->session()->forget("mutate");
        $category->load(array("film",));
        return view('category_display', compact('category'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Category $category )
    {
        request()->session()->forget("mutate");
        $category->load(array("film",));
        return view('category_edit', compact('category'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Category $category )
    {
            $category->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Category $category )
    {
            $category->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Category $category ){

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
        $category->load(array("film",));
return view('category_related', compact(['category', 'table']));
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

        $categorys = Category::where('category_id', 'like', $keyword)
         ->orWhere('category_id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

         ->orWhere('last_update', 'like', $keyword)

        ->paginate(20);
    $categorys->setPath("search?keyword=$keyword");
    return view('category_show', compact('categorys'));
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
$categorys = Category::query();
         if(request()->exists('name')){
            $categorys = $categorys->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
          $categorys = $categorys->paginate(20);
        $categorys->setPath("sort?$path");
        return view('category_show', compact('categorys'));

    }else{

    if(request()->exists('tab') == 'film'){

                  if(request()->exists('title')){
             session(['sortOrder' => $this->getOrder('title')]);
             session(['sortKey' => 'title']);
        }else{
            request()->session()->forget("title");
        }

                 if(request()->exists('description')){
             session(['sortOrder' => $this->getOrder('description')]);
             session(['sortKey' => 'description']);
        }else{
            request()->session()->forget("description");
        }

                 if(request()->exists('release_year')){
             session(['sortOrder' => $this->getOrder('release_year')]);
             session(['sortKey' => 'release_year']);
        }else{
            request()->session()->forget("release_year");
        }

                  if(request()->exists('rental_duration')){
             session(['sortOrder' => $this->getOrder('rental_duration')]);
             session(['sortKey' => 'rental_duration']);
        }else{
            request()->session()->forget("rental_duration");
        }

                 if(request()->exists('rental_rate')){
             session(['sortOrder' => $this->getOrder('rental_rate')]);
             session(['sortKey' => 'rental_rate']);
        }else{
            request()->session()->forget("rental_rate");
        }

                 if(request()->exists('length')){
             session(['sortOrder' => $this->getOrder('length')]);
             session(['sortKey' => 'length']);
        }else{
            request()->session()->forget("length");
        }

                 if(request()->exists('replacement_cost')){
             session(['sortOrder' => $this->getOrder('replacement_cost')]);
             session(['sortKey' => 'replacement_cost']);
        }else{
            request()->session()->forget("replacement_cost");
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



    function addFilm(Category $category ){
    $category->film()->sync(request()->get('film'));
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


<?php 
namespace App\Http\Controllers;

use App\Film;
    use App\Language;

    use App\Category;

     
class FilmController extends Controller {

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


        return view('film_show', ['films' => Film::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('film');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $film = Film::create([
              "title" => $data["title"],
             "description" => $data["description"],
             "release_year" => $data["release_year"],
              "rental_duration" => $data["rental_duration"],
             "rental_rate" => $data["rental_rate"],
             "length" => $data["length"],
             "replacement_cost" => $data["replacement_cost"],
            ]);

            if(request()->exists('language')){
            $language = Language::find(request()->get('language'));
            $film->language()->associate($language)->save();
        }
             if(request()->exists('category')){
        $film->category()->attach($data["category"]);
        }
      
        return redirect('/film');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Film $film )
    {
        request()->session()->forget("mutate");
        $film->load(array("language","category",));
        return view('film_display', compact('film'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Film $film )
    {
        request()->session()->forget("mutate");
        $film->load(array("language","category",));
        return view('film_edit', compact('film'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Film $film )
    {
            $film->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Film $film )
    {
            $film->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Film $film ){

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
        $film->load(array("language","category",));
return view('film_related', compact(['film', 'table']));
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

        $films = Film::where('film_id', 'like', $keyword)
         ->orWhere('film_id', 'like', $keyword)

         ->orWhere('language_id', 'like', $keyword)

         ->orWhere('title', 'like', $keyword)

         ->orWhere('description', 'like', $keyword)

         ->orWhere('release_year', 'like', $keyword)

         ->orWhere('original_language_id', 'like', $keyword)

         ->orWhere('rental_duration', 'like', $keyword)

         ->orWhere('rental_rate', 'like', $keyword)

         ->orWhere('length', 'like', $keyword)

         ->orWhere('replacement_cost', 'like', $keyword)

         ->orWhere('rating', 'like', $keyword)

         ->orWhere('special_features', 'like', $keyword)

         ->orWhere('last_update', 'like', $keyword)

        ->paginate(20);
    $films->setPath("search?keyword=$keyword");
    return view('film_show', compact('films'));
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
$films = Film::query();
          if(request()->exists('title')){
            $films = $films->orderBy('title', $this->getOrder('title'));
            $path = "title";
        }else{
            request()->session()->forget("title");
        }
         if(request()->exists('description')){
            $films = $films->orderBy('description', $this->getOrder('description'));
            $path = "description";
        }else{
            request()->session()->forget("description");
        }
         if(request()->exists('release_year')){
            $films = $films->orderBy('release_year', $this->getOrder('release_year'));
            $path = "release_year";
        }else{
            request()->session()->forget("release_year");
        }
          if(request()->exists('rental_duration')){
            $films = $films->orderBy('rental_duration', $this->getOrder('rental_duration'));
            $path = "rental_duration";
        }else{
            request()->session()->forget("rental_duration");
        }
         if(request()->exists('rental_rate')){
            $films = $films->orderBy('rental_rate', $this->getOrder('rental_rate'));
            $path = "rental_rate";
        }else{
            request()->session()->forget("rental_rate");
        }
         if(request()->exists('length')){
            $films = $films->orderBy('length', $this->getOrder('length'));
            $path = "length";
        }else{
            request()->session()->forget("length");
        }
         if(request()->exists('replacement_cost')){
            $films = $films->orderBy('replacement_cost', $this->getOrder('replacement_cost'));
            $path = "replacement_cost";
        }else{
            request()->session()->forget("replacement_cost");
        }
            $films = $films->paginate(20);
        $films->setPath("sort?$path");
        return view('film_show', compact('films'));

    }else{

    if(request()->exists('tab') == 'language'){

                 if(request()->exists('name')){
             session(['sortOrder' => $this->getOrder('name')]);
             session(['sortKey' => 'name']);
        }else{
            request()->session()->forget("name");
        }

                  }
    if(request()->exists('tab') == 'category'){

                 if(request()->exists('name')){
             session(['sortOrder' => $this->getOrder('name')]);
             session(['sortKey' => 'name']);
        }else{
            request()->session()->forget("name");
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



    function updateLanguage(Film $film ){
    $language = \App\Language::find(request()->get('language'));
    $film->language()->associate($language)->save();
    return back();
}
function addCategory(Film $film ){
    $film->category()->sync(request()->get('category'));
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


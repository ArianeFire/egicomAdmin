<?php 
namespace App\Http\Controllers;

use App\Language;
    use App\Film;

     
class LanguageController extends Controller {

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


        return view('language_show', ['languages' => Language::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('language');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $language = Language::create([
             "name" => $data["name"],
          ]);

      
        return redirect('/language');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Language $language )
    {
        request()->session()->forget("mutate");
        $language->load(array("film",));
        return view('language_display', compact('language'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Language $language )
    {
        request()->session()->forget("mutate");
        $language->load(array("film",));
        return view('language_edit', compact('language'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Language $language )
    {
            $language->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Language $language )
    {
            $language->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Language $language ){

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
        $language->load(array("film",));
return view('language_related', compact(['language', 'table']));
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

        $languages = Language::where('language_id', 'like', $keyword)
         ->orWhere('language_id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

         ->orWhere('last_update', 'like', $keyword)

        ->paginate(20);
    $languages->setPath("search?keyword=$keyword");
    return view('language_show', compact('languages'));
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
$languages = Language::query();
         if(request()->exists('name')){
            $languages = $languages->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
          $languages = $languages->paginate(20);
        $languages->setPath("sort?$path");
        return view('language_show', compact('languages'));

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



    function addFilm(Language $language ){
    $language->film()->sync(request()->get('film'));
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


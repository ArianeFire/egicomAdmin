<?php 
namespace App\Http\Controllers;

use App\Delivery;
    use App\Film;

     
class DeliveryController extends Controller {

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


        return view('delivery_show', ['deliverys' => Delivery::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('delivery');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $delivery = Delivery::create([
             "identifiant" => $data["identifiant"],
             "date" => $data["date"],
             "articles" => $data["articles"],
         ]);

      
        return redirect('/delivery');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Delivery $delivery )
    {
        request()->session()->forget("mutate");
        $delivery->load(array("film",));
        return view('delivery_display', compact('delivery'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Delivery $delivery )
    {
        request()->session()->forget("mutate");
        $delivery->load(array("film",));
        return view('delivery_edit', compact('delivery'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Delivery $delivery )
    {
            $delivery->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Delivery $delivery )
    {
            $delivery->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Delivery $delivery ){

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
        $delivery->load(array("film",));
return view('delivery_related', compact(['delivery', 'table']));
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

        $deliverys = Delivery::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('identifiant', 'like', $keyword)

         ->orWhere('date', 'like', $keyword)

         ->orWhere('articles', 'like', $keyword)

        ->paginate(20);
    $deliverys->setPath("search?keyword=$keyword");
    return view('delivery_show', compact('deliverys'));
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
$deliverys = Delivery::query();
         if(request()->exists('identifiant')){
            $deliverys = $deliverys->orderBy('identifiant', $this->getOrder('identifiant'));
            $path = "identifiant";
        }else{
            request()->session()->forget("identifiant");
        }
         if(request()->exists('date')){
            $deliverys = $deliverys->orderBy('date', $this->getOrder('date'));
            $path = "date";
        }else{
            request()->session()->forget("date");
        }
         if(request()->exists('articles')){
            $deliverys = $deliverys->orderBy('articles', $this->getOrder('articles'));
            $path = "articles";
        }else{
            request()->session()->forget("articles");
        }
         $deliverys = $deliverys->paginate(20);
        $deliverys->setPath("sort?$path");
        return view('delivery_show', compact('deliverys'));

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



    
 
    private function getOrder($param){
        if(session($param, "none") != "none"){
            session([$param => session($param, 'asc') == 'asc' ? 'desc':'asc']);
        }else{
            session([$param => 'asc']);
        }
        return session($param);
    }



}


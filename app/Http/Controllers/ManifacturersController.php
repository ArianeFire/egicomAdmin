<?php 
namespace App\Http\Controllers;

use App\Manifacturers;
    use App\Products;

     
class ManifacturersController extends Controller {

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


        return view('manifacturers_show', ['manifacturerss' => Manifacturers::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('manifacturers');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $manifacturers = Manifacturers::create([
             "name" => $data["name"],
         ]);

      
        return redirect('/manifacturers');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Manifacturers $manifacturers )
    {
        request()->session()->forget("mutate");
        $manifacturers->load(array("products",));
        return view('manifacturers_display', compact('manifacturers'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Manifacturers $manifacturers )
    {
        request()->session()->forget("mutate");
        $manifacturers->load(array("products",));
        return view('manifacturers_edit', compact('manifacturers'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Manifacturers $manifacturers )
    {
            $manifacturers->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Manifacturers $manifacturers )
    {
            $manifacturers->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Manifacturers $manifacturers ){

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
        $manifacturers->load(array("products",));
return view('manifacturers_related', compact(['manifacturers', 'table']));
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

        $manifacturerss = Manifacturers::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

        ->paginate(20);
    $manifacturerss->setPath("search?keyword=$keyword");
    return view('manifacturers_show', compact('manifacturerss'));
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
$manifacturerss = Manifacturers::query();
         if(request()->exists('name')){
            $manifacturerss = $manifacturerss->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
         $manifacturerss = $manifacturerss->paginate(20);
        $manifacturerss->setPath("sort?$path");
        return view('manifacturers_show', compact('manifacturerss'));

    }else{

    if(request()->exists('tab') == 'products'){

                 if(request()->exists('name')){
             session(['sortOrder' => $this->getOrder('name')]);
             session(['sortKey' => 'name']);
        }else{
            request()->session()->forget("name");
        }

                 if(request()->exists('availability')){
             session(['sortOrder' => $this->getOrder('availability')]);
             session(['sortKey' => 'availability']);
        }else{
            request()->session()->forget("availability");
        }

                 if(request()->exists('warranty')){
             session(['sortOrder' => $this->getOrder('warranty')]);
             session(['sortKey' => 'warranty']);
        }else{
            request()->session()->forget("warranty");
        }

                 if(request()->exists('transport')){
             session(['sortOrder' => $this->getOrder('transport')]);
             session(['sortKey' => 'transport']);
        }else{
            request()->session()->forget("transport");
        }

                 if(request()->exists('hasTVA')){
             session(['sortOrder' => $this->getOrder('hasTVA')]);
             session(['sortKey' => 'hasTVA']);
        }else{
            request()->session()->forget("hasTVA");
        }

                 if(request()->exists('description')){
             session(['sortOrder' => $this->getOrder('description')]);
             session(['sortKey' => 'description']);
        }else{
            request()->session()->forget("description");
        }

                 if(request()->exists('normalPrice')){
             session(['sortOrder' => $this->getOrder('normalPrice')]);
             session(['sortKey' => 'normalPrice']);
        }else{
            request()->session()->forget("normalPrice");
        }

                 if(request()->exists('promoPrice')){
             session(['sortOrder' => $this->getOrder('promoPrice')]);
             session(['sortKey' => 'promoPrice']);
        }else{
            request()->session()->forget("promoPrice");
        }

                 if(request()->exists('bigImageUrl')){
             session(['sortOrder' => $this->getOrder('bigImageUrl')]);
             session(['sortKey' => 'bigImageUrl']);
        }else{
            request()->session()->forget("bigImageUrl");
        }

                 if(request()->exists('smallImageUrl')){
             session(['sortOrder' => $this->getOrder('smallImageUrl')]);
             session(['sortKey' => 'smallImageUrl']);
        }else{
            request()->session()->forget("smallImageUrl");
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



    function addProducts(Manifacturers $manifacturers ){
    $manifacturers->products()->sync(request()->get('products'));
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


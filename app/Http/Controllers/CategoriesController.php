<?php 
namespace App\Http\Controllers;

use App\Categories;
    use App\Products;

     
class CategoriesController extends Controller {

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


        return view('categories_show', ['categoriess' => Categories::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('categories');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
            $data = request()->all();

    $categories = Categories::create([
             "name" => $data["name"],
         ]);

            if(request()->exists('products')){
        $categories->products()->attach($data["products"]);
        }
      
        return redirect('/categories');;
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Categories $categories )
    {
        request()->session()->forget("mutate");
        $categories->load(array("products",));
        return view('categories_display', compact('categories'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Categories $categories )
    {
        request()->session()->forget("mutate");
        $categories->load(array("products",));
        return view('categories_edit', compact('categories'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Categories $categories )
    {
            $categories->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Categories $categories )
    {
            $categories->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Categories $categories ){

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
        $categories->load(array("products",));
return view('categories_related', compact(['categories', 'table']));
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

        $categoriess = Categories::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

        ->paginate(20);
    $categoriess->setPath("search?keyword=$keyword");
    return view('categories_show', compact('categoriess'));
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
$categoriess = Categories::query();
         if(request()->exists('name')){
            $categoriess = $categoriess->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
         $categoriess = $categoriess->paginate(20);
        $categoriess->setPath("sort?$path");
        return view('categories_show', compact('categoriess'));

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

                 if(request()->exists('category_id')){
             session(['sortOrder' => $this->getOrder('category_id')]);
             session(['sortKey' => 'category_id']);
        }else{
            request()->session()->forget("category_id");
        }

                 if(request()->exists('manifacturer_id')){
             session(['sortOrder' => $this->getOrder('manifacturer_id')]);
             session(['sortKey' => 'manifacturer_id']);
        }else{
            request()->session()->forget("manifacturer_id");
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



    function addProducts(Categories $categories ){
    $categories->products()->sync(request()->get('products'));
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


<?php 
namespace App\Http\Controllers;

use App\Products;
    use App\Manifacturers;

    use App\Categories;

     
class ProductsController extends Controller {

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


        return view('products_show', ['productss' => Products::paginate(20)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  Response
    */
    public function create()
    {
        return view('products');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return  Response
    */
    public function store()
    {
        $data = request()->all();

        $products = Products::create([
             "name" => $data["name"],
             "availability" => ($data["availability"] == "on" ? 1 : 0),
             "warranty" => $data["warranty"],
             "transport" => $data["transport"],
             "hasTVA" => ($data["hasTVA"] == "on" ? 1 : 0),
             "description" => $data["description"],
             "normalPrice" => $data["normalPrice"],
             "promoPrice" => $data["promoPrice"],
             "bigImageUrl" => $data["bigImageUrl"],
             "smallImageUrl" => $data["smallImageUrl"],
         ]);

        if(request()->exists('manifacturers')){
            $manifacturers = Manifacturers::find(request()->get('manifacturers'));
            $products->manifacturers()->associate($manifacturers)->save();
        }

        if(request()->exists('categories')){
            $products->categories()->attach($data["categories"]);
        }
      
        return redirect('/products');
    }

    /**
    * Display the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function show(Products $products )
    {
        request()->session()->forget("mutate");
        $products->load(array("manifacturers","categories",));
        return view('products_display', compact('products'));        }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    Mixed
    * @return  Response
    */
    public function edit(Products $products )
    {
        request()->session()->forget("mutate");
        $products->load(array("manifacturers","categories",));
        return view('products_edit', compact('products'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function update(Products $products )
    {
            $products->update(request()->all());

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    Mixed
    * @return  Response
    */
    public function destroy(Products $products )
    {
        $products->delete();
        return back();
    }

    /**
    * Load and display related tables.
    * @param    Mixed
    * @return  Response
    */
    public function related(Products $products ){

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
        $products->load(array("manifacturers","categories",));
return view('products_related', compact(['products', 'table']));
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

        $productss = Products::where('id', 'like', $keyword)
         ->orWhere('id', 'like', $keyword)

         ->orWhere('name', 'like', $keyword)

         ->orWhere('availability', 'like', $keyword)

         ->orWhere('warranty', 'like', $keyword)

         ->orWhere('transport', 'like', $keyword)

         ->orWhere('hasTVA', 'like', $keyword)

         ->orWhere('description', 'like', $keyword)

         ->orWhere('normalPrice', 'like', $keyword)

         ->orWhere('promoPrice', 'like', $keyword)

         ->orWhere('bigImageUrl', 'like', $keyword)

         ->orWhere('smallImageUrl', 'like', $keyword)

        ->paginate(20);
    $productss->setPath("search?keyword=$keyword");
    return view('products_show', compact('productss'));
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
$productss = Products::query();
         if(request()->exists('name')){
            $productss = $productss->orderBy('name', $this->getOrder('name'));
            $path = "name";
        }else{
            request()->session()->forget("name");
        }
         if(request()->exists('availability')){
            $productss = $productss->orderBy('availability', $this->getOrder('availability'));
            $path = "availability";
        }else{
            request()->session()->forget("availability");
        }
         if(request()->exists('warranty')){
            $productss = $productss->orderBy('warranty', $this->getOrder('warranty'));
            $path = "warranty";
        }else{
            request()->session()->forget("warranty");
        }
         if(request()->exists('transport')){
            $productss = $productss->orderBy('transport', $this->getOrder('transport'));
            $path = "transport";
        }else{
            request()->session()->forget("transport");
        }
         if(request()->exists('hasTVA')){
            $productss = $productss->orderBy('hasTVA', $this->getOrder('hasTVA'));
            $path = "hasTVA";
        }else{
            request()->session()->forget("hasTVA");
        }
         if(request()->exists('description')){
            $productss = $productss->orderBy('description', $this->getOrder('description'));
            $path = "description";
        }else{
            request()->session()->forget("description");
        }
         if(request()->exists('normalPrice')){
            $productss = $productss->orderBy('normalPrice', $this->getOrder('normalPrice'));
            $path = "normalPrice";
        }else{
            request()->session()->forget("normalPrice");
        }
         if(request()->exists('promoPrice')){
            $productss = $productss->orderBy('promoPrice', $this->getOrder('promoPrice'));
            $path = "promoPrice";
        }else{
            request()->session()->forget("promoPrice");
        }
         if(request()->exists('bigImageUrl')){
            $productss = $productss->orderBy('bigImageUrl', $this->getOrder('bigImageUrl'));
            $path = "bigImageUrl";
        }else{
            request()->session()->forget("bigImageUrl");
        }
         if(request()->exists('smallImageUrl')){
            $productss = $productss->orderBy('smallImageUrl', $this->getOrder('smallImageUrl'));
            $path = "smallImageUrl";
        }else{
            request()->session()->forget("smallImageUrl");
        }
         $productss = $productss->paginate(20);
        $productss->setPath("sort?$path");
        return view('products_show', compact('productss'));

    }else{

    if(request()->exists('tab') == 'manifacturers'){

                 if(request()->exists('name')){
             session(['sortOrder' => $this->getOrder('name')]);
             session(['sortKey' => 'name']);
        }else{
            request()->session()->forget("name");
        }

                 }
    if(request()->exists('tab') == 'categories'){

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



    function updateManifacturers(Products $products ){
    $manifacturers = \App\Manifacturers::find(request()->get('manifacturers'));
    $products->manifacturers()->associate($manifacturers)->save();
    return back();
}
function addCategories(Products $products ){
    $products->categories()->sync(request()->get('categories'));
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


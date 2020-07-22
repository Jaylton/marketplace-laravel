<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductsController extends Controller
{
    private $product;
    use UploadTrait;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;
        if(!$userStore->store()->exists()){
        flash('É preciso criar loja para ter produtos')->warning();
            $products = [];
        }else{
            $products = $userStore->products()->paginate(10);
        }
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $store = auth()->user()->store;// \App\Store::find($data['store']);
        $product = $store->products()->create($data);
        $product->categories()->sync($data['categories']);
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request, 'image');

            $product->photos()->createMany($images);
        }
        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = \App\Category::all(['id', 'name']);
        $product = $this->product->findOrFail($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = $this->product->find($id);
        $product->categories()->sync($data['categories']);
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request, 'image');

            $product->photos()->createMany($images);
        }
        $product->update($data);

        flash('Produto editado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = $this->product->find($id);
        $product->delete();

        flash('Produto excluido com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    // private function imageUpload(Request $request, $imageColumn){
    //     $images = $request->file('photos');
    //     $uploadedImages = [];
    //     foreach($images as $im){
    //         $uploadedImages[] =[$imageColumn => $im->store('products','public') ];
    //     }

    //     return $uploadedImages;

    // }
}

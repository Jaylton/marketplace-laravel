<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct(){
        $this->middleware('user.has.store')->only(['create','store']);
    }


    public function index(){
        $store = auth()->user()->store;
        return view('admin.store.index', compact('store'));
    }
    public function create(){
        return view('admin.store.create');
    }

    public function store(StoreRequest $request){
        $data = $request->all();
        $user = auth()->user();
        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request);
        }
        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index')->withInput()->withErrors('Add atleast one image in the post.');
    }

    public function edit($store){
        $store = \App\Store::find($store);
        return view('admin.store.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store){
        $store = \App\Store::find($store);
        $data = $request->all();
        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $this->imageUpload($request);
        }
        $store->update($data);

        flash('Loja atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');

        // return $store;
    }

    public function del($store){
        $store = \App\Store::find($store);
        $store->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}','CategoryController@index')->name('category.single');
Route::get('/store/{slug}','StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/','CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove/{slug}','CartController@remove')->name('remove');
    Route::get('cancel','CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/process', 'CheckoutController@process')->name('process');
    Route::get('/thanks','CheckoutController@thanks')->name('thanks');
    Route::post('/notification', 'CheckoutController@notificaiton')->name('notification');
});

Route::get('/model', function () {

    // $user = new \App\User();
    // $user = \App\User::find(1);
    // $user->name = 'Usuário editado';
    // $user->email = 'teste@teste.com';
    // $user->password = bcrypt('123456');
    // $user->save();
    // return \App\User::all();
    // $products = \App\Product::all();
    // return $products;

    //mass assigment
    // $user = \App\User::create([
    //     'name' => 'Useroo',
    //     'email' => 'jayltonokra15@gmail.com',
    //     'password' => bcrypt('123456')
    // ]);
    //mass update
    // $user = \App\User::find(2);
    // $user->update([
    //     'name' => 'atualizacso'
    // ]);
    //return \App\User::all();

    //Como eu faria para pegar a loja de um usuario
    // $user = \App\User::find(4);
    // return $user->store()->get();

    //Como eu faria para pegar os pordutos de uma loja
    // $store = \App\Store::find(1);
    // return $store->products;

    //Criar uma loja para um usario
    // $user = \App\User::find(2);
    // $store = $user->store()->create([
    //     'name' => 'loja teste',
    //     'description' => 'loja teste descricao',
    //     'phone' => '000000000',
    //     'mobile_phone' => '9000000000',
    //     'slug' => 'loja-teste'
    // ]);
    // return $store;

    //criar um produto para uma loja
    // $store = \App\Store::find(11);
    // $product = $store->products()->create([
    //     'name' => 'Notebook dell',
    //     'description'=> 'fskdjfsd hskdfh s kjdhfsjkhfskdfjhsd',
    //     'body'=> 'asdadlaskjd lkasj dkajsdlaj skdjals dkajdk ajsdl kjaskldjalkjsdkaj slkdj',
    //     'slug'=> 'notebook',
    //     'price'=> 3000.99,
    // ]);
    //     return $product;

    //criar uma categoria
    // \App\Category::create([
    //     'name' => 'Notebooks',
    //     'description' => 'asdasdasdasd',
    //     'slug' => 'notebooks'
    // ]);

    // \App\Category::create([
    //     'name' => 'games',
    //     'description' => 'asdasdasdasd',
    //     'slug' => 'notebooks'
    // ]);
    // return \App\Category::all();


    //adicionar um produto para uma categoria
    $product =\App\Product::find(1);
    return $product->categories()->sync([1,2]); //attach add - detach remove

});

Route::get('my-orders','UserOrderController@index')->name('user.orders')->middleware('auth');
Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        Route::prefix('stores')->name('stores.')->group(function(){// *
            Route::get('/', 'StoreController@index')->name('index');
            Route::get('/create', 'StoreController@create')->name('create');
            Route::post('/store', 'StoreController@store')->name('store');
            Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
            Route::post('/update/{store}', 'StoreController@update')->name('update');
            Route::get('/delete/{store}', 'StoreController@del')->name('delete');
        });
        Route::resource('products', 'ProductsController'); //substitui tudo aquilo de *
        Route::resource('categories', 'CategoriesController'); //substitui tudo aquilo de *
        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
        Route::get('orders/my','OrdersController@index')->name('orders.index');
        Route::get('notifications', 'NotificationController@notifications')->name('notification.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notification.read.all');
        Route::get('notifications/read/{id}', 'NotificationController@readAll')->name('notification.read.noti');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

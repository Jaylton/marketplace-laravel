<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    protected $table = 'stores'; //não é preciso quando o nome do model é o singular do nome da tabela

    protected $fillable = [
        'name', 'description', 'phone', 'mobile_phone',  'slug', 'logo'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners($storesId){
        $stores = $this->whereIn('id', $storesId)->get();
        $userStores = $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
        foreach($userStores as $us){

        }
    }
}

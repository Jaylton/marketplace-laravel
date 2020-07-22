<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait{
    private function imageUpload(Request $request, $imageColumn = null){
        $uploadedImages = [];
        if(!is_null($imageColumn)){
            $images = $request->file('photos');
            foreach($images as $im){
                $uploadedImages[] =[$imageColumn => $im->store('products','public') ];
            }
        }else{
            $images = $request->file('logo');
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;

    }
}

?>

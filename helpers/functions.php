<?php
 function filterItensByStoreId(array $itens, $storeId){
    return array_filter($itens, function($line) use($storeId){
        return $line['store_id'] == $storeId;
    });
 }

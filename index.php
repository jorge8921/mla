<?php
$items_id = json_decode( file_get_contents('https://api.mercadolibre.com/sites/MLA/search?seller_id=179571326'), true );
$file=fopen("mla.log", "w") or die("No se puede iniciar el archivo!");
$n=1;
 foreach($items_id['results'] as $result){
     $item_id=array('id' => $result['id']);
     $item_title=array('title' => $result['title']);
     $item_category_id=array('category_id' => $result['category_id']);
     $item_category_name=json_decode( file_get_contents('https://api.mercadolibre.com/categories/'.$item_category_id["category_id"].''), true );
     $log= $n.' '.$item_id['id'].'|'.$item_title['title'].'|'.$item_category_id['category_id'].'|'.$item_category_name['name'];
     $n++;
     fwrite($file, $log);
     fwrite ($file, "\n");
 }
 fclose($file);
?>
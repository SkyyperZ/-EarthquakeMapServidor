<?php
$earthquake = simplexml_load_file('http://www.ign.es/ign/RssTools/sismologia.xml');


$earthquake->item;


$arrCoso="[";
foreach ($earthquake ->channel[0]->item as $eaq){
    $troceo = explode(" ",$eaq->description);
    $magni = '"maginitud": "'.$troceo[7].'", ';
    $fecha = array_search("fecha",$troceo);
    $latNo = array_search("localización:",$troceo);

    $troNomb = stripos($eaq ->description, 'en ')+strlen('en ');
    $finNomb= stripos($eaq ->description, ' en',$troNomb);
    $loc = substr($eaq->description, $troNomb,$finNomb-$troNomb);

    $lat = explode(",",$troceo[$latNo+1])[0];
    $long = explode(",",$troceo[$latNo+1])[1];



    $arrCoso .= "{".$magni.'"fecha": "'.$troceo[$fecha+1].'", '.'"hora": "'.$troceo[$fecha+2].'", '.'"nombre": "'.$loc.'", '.'"link": "'.$eaq->link.'", '.'"lat": "'.$lat.'", '.'"long": "'.$long.'"'.'},';



}
$arrCoso = substr($arrCoso,0,-1);
print_r($arrCoso);
echo ']';

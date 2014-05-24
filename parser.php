<?php

$zapros = 'авто';
$search = iconv("WINDOWS-1251", "UTF-8", $zapros); 
$json = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&rsz=3&imgsz=medium&q='.urlencode($search).'&start=10'); 
$data = json_decode($json); 
echo count($data);
if ($data->responseData->results[0]->unescapedUrl != '') 
$url = $data->responseData->results[0]->unescapedUrl; 
else 
$url = 'none.jpg';
echo '<p><img src="'.$url.'" alt="" title=""></p>';
die();



$c = count($data->responseData->results);
for ($i = 0; $i <= $c; $i++) {
    if ($data->responseData->results[$i]->unescapedUrl != '') 
        $url = $data->responseData->results[$i]->unescapedUrl; 
    else 
        $url = 'none.jpg';
    echo '<p><img src="'.$url.'" alt="" title=""></p>';

}









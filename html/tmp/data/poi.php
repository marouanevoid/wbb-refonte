<?php
header('Content-type: application/json');


 $bars = array
 (
    array('id'=>1, 'address'=>"189 Spring St, Soho, New York", 'name'=>"Achiles Heel", 'url'=>"bar-details.php"),
    array('id'=>2, 'address'=>"163 Spring St, Soho, New York", 'name'=>"Alameda", 'url'=>"bar-details.php"),
    array('id'=>3, 'address'=>"220 Houston St, Soho, New York", 'name'=>"Atrium", 'url'=>"bar-details.php"),
    array('id'=>4, 'address'=>"382 Prince  St, Soho, New York", 'name'=>"Bar Below Rye", 'url'=>"bar-details.php"),
 );

 $neighborhood = array
 (
     array('id'=>1, 'name'=>"Neighborhood 1"),
     array('id'=>2, 'name'=>"Neighborhood 2"),
     array('id'=>3, 'name'=>"Neighborhood 3"),
     array('id'=>4, 'name'=>"Neighborhood 4"),
 );

echo json_encode(array('code'=>200, 'bars'=>$bars, 'neighborhoods'=>$neighborhood));
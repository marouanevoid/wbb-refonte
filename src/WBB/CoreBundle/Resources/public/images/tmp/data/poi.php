<?php
header('Content-type: application/json');


 $bars = array
 (
    array('id'=>1, 'address'=>"189 Spring St, Soho, New York", 'name'=>"Achiles Heel"),
    array('id'=>2, 'address'=>"163 Spring St, Soho, New York", 'name'=>"Alameda"),
    array('id'=>3, 'address'=>"220 Houston St, Soho, New York", 'name'=>"Atrium"),
    array('id'=>4, 'address'=>"382 Prince  St, Soho, New York", 'name'=>"Bar Below Rye"),
 );

 $neighborhood = array
 (
     array('id'=>1, 'name'=>"Neighborhood 1"),
     array('id'=>2, 'name'=>"Neighborhood 2"),
     array('id'=>3, 'name'=>"Neighborhood 3"),
     array('id'=>4, 'name'=>"Neighborhood 4"),
 );

echo json_encode(array('code'=>200, 'bars'=>$bars, 'neighborhoods'=>$neighborhood));
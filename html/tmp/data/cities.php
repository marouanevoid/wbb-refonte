<?php
header('Content-type: application/json');


 $cities = array
 (
    array('id'=>'nice-france', 'name'=>"Nice, France"),
    array('id'=>'madrid-espana', 'name'=>"Madrid, Espana"),
    array('id'=>'roma-italy', 'name'=>"Roma, Italy"),
    array('id'=>'new_york-new_york', 'name'=>"New York, New York")
 );


echo json_encode(array('code'=>200, 'cities'=>$cities));
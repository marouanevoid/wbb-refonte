<?php
header('Content-type: application/json');


 $cities = array
 (
    array('id'=>'nice-france', 'name'=>"Nice, France"),
    array('id'=>'madrid-espana', 'name'=>"Madrid, Espana"),
    array('id'=>'roma-italy', 'name'=>"Roma, Italy"),
    array('id'=>'new_york-new_york', 'name'=>"New York, New York"),
    array('id'=>'paris-france', 'name'=>"Paris, France"),
    array('id'=>'chicago-illinois', 'name'=>"Chicago, Illinois"),
    array('id'=>'los_angeles-californie', 'name'=>"Los Angeles, Californie"),
 );


echo json_encode(array('code'=>200, 'cities'=>$cities));
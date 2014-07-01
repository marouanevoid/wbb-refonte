<?php
header('Content-type: application/json');

$response = array( 'code'=>200, 'q'=>$_POST['q'], 'values'=>array
(
    array('name'=>'New York'),
    array('name'=>'Paris'),
    array('name'=>'Madrid'),
    array('name'=>'Helsinki'),
    array('name'=>'New York'),
    array('name'=>'Paris'),
    array('name'=>'Madrid'),
    array('name'=>'Helsinki')
));

echo json_encode($response);
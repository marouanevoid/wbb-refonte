<?php

    header('Content-type: application/json');

    $tip = $_POST['tip'];

    if(empty($tip)) $reponse = array('code'=>300, 'message'=>'Tip is empty');
    else $reponse = array('code'=>200, 'message'=>'Tip submitted!');

    echo json_encode($reponse);
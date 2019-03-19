<?php

require_once('app/core/Model.php');
require_once('app/core/Controller.php');

$con = new Model();
$controller = new Controller();

//your database changes here...
$data = array(
    'code' => 'SPE',
    'description' => 'Sputum Examination'
);

$check = $controller->compare('services',$data);
if(!$check){
    $controller->save('services',$data);
    $tmp_id = $controller->getID('services',$data);
    for($i=5;$i<=8;$i++){
        $insert = array(
            'bracket_id' => $i,
            'service_id' => $tmp_id
        );
        $controller->save('bracketservices',$insert);
    }
}

//your database changes here...
$data = array(
    'code' => 'RBS',
    'description' => 'Random Blood Sugar'
);

$check = $controller->compare('services',$data);
if(!$check){
    $controller->save('services',$data);
    $tmp_id = $controller->getID('services',$data);
    for($i=5;$i<=8;$i++){
        $insert = array(
            'bracket_id' => $i,
            'service_id' => $tmp_id
        );
        $controller->save('bracketservices',$insert);
    }
}


//
//$myfile = fopen("patch.php", "w") or die("Unable to open file!");
//$txt = "";
//fwrite($myfile, $txt);
//fclose($myfile);
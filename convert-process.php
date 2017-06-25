<?php
require "Adapter.php";

function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

$name = $_POST['name'];
$uk = $_POST['uk-odd'];
$eu = $_POST['eu-odd'];
$us = $_POST['us-odd'];



$valueError = [];
$valid = true;

if (empty($name)) {
    $valueError[] = "Please give your name";
    $valid = false;
}

if (!empty($uk) && !empty($eu) && !empty($us)) {
    $valueError[]= "You gave more than one odd. please give one odd.<br>";
    $valid = false;

}
if (!empty($uk) && !empty($eu)) {
    $valueError[] = "You gave more than one odd. please give one odd.<br>";
    $valid = false;

}
if (!empty($uk) && !empty($us)) {
    $valueError[] = "You gave more than one odd. please give one odd.<br>";
    $valid = false;
}


if (empty($uk) && empty($us) && empty($eu)) {

    $valueError[] = "Please give a value.<br>";
}

if(!empty($valueError)){
    $result_array = array('errors'=>$valueError);
    echo json_encode($result_array);
    exit;
}



if ($valid) {

    $odds = new Adapter();
    $data = $odds->oddsSelection($uk, $eu, $us);


    if (is_ajax_request()) {
        echo json_encode($data,JSON_PRETTY_PRINT);

    } else {
        exit;
    }
}
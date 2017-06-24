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


$nameError = null;
$valueError = null;
$valid = true;

if (empty($name)) {
    $nameError = "Please give your name";
    $valid = false;
}

if (!empty($uk) && !empty($eu) && !empty($us)) {
    $valueError = "You gave more than one odd. please give one odd.<br>";
    $valid = false;

} elseif (!empty($uk) && !empty($eu)) {
    $valueError = "You gave more than one odd. please give one odd.<br>";
    $valid = false;

} elseif (!empty($uk) && !empty($us)) {
    $valueError = "You gave more than one odd. please give one odd.<br>";
    $valid = false;
} else {

    $valueError = "Please give a value.<br>";
}


if ($valid) {

    /* $conn = Database::connect();
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "INSERT INTO users (name) values(?)";
     $query = $conn->prepare($sql);
     $query->execute(array($name));

     $sql2 = "INSERT INTO history_values (value,value_type) values(?,?)";
     $query = $conn->prepare($sql2);
     $query->execute(array($value, $valueType));

     Database::disconnect();*/

    $odds = new Adapter();
    $data = $odds->oddsSelection($uk, $eu, $us);


    if (is_ajax_request()) {
        echo "the name you typed is " . $data['name'] . '<br>';
        echo "the uk you typed is " . $data['UK'] . '<br>';
        echo "the eu you typed is " . $data['EU'] . '<br>';
        echo "the us you typed is " . $data['US'].'<br>';
    } else {
        exit;
    }
}
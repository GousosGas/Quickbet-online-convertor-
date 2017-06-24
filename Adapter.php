<?php

require_once "Database.php";


class Adapter
{

 public function oddsSelection($uk_odd,$eu_odd,$us_odd){

     if(!empty($uk_odd)){
         return $this->ukOddSelection($uk_odd);
     }elseif (!empty($eu_odd)){
         return $this->euOddSelection($eu_odd);
     }else{
         return $this->usOddSelection($us_odd);
     }

 }


protected function ukOddSelection($uk_odd){
    $pdo =Database::connect();
    $sql="select EU,US from chart_values where UK =?";
    $query = $pdo->prepare($sql);
    $query->execute(array($uk_odd));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    return $data;

}

protected function euOddSelection($eu_odd){
    $pdo =Database::connect();
    $sql="select UK,US from chart_values where EU =?";
    $query = $pdo->prepare($sql);
    $query->execute(array($eu_odd));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    return $data;

}



protected function usOddSelection($us_odd){
    $pdo =Database::connect();
    $sql="select EU,UK from  chart_values where US =?";
    $query = $pdo->prepare($sql);
    $query->execute(array($us_odd));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    return $data;

}



}
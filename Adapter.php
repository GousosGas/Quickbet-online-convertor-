<?php

require "Database.php";


class Adapter
{
    /*Adapter for choose the correct selection */
    public function oddsSelection($uk_odd, $eu_odd, $us_odd)
    {

        if (!empty($uk_odd)) {
            return $this->ukOddSelection($uk_odd);
        } elseif (!empty($eu_odd)) {
            return $this->euOddSelection($eu_odd);
        } else {
            return $this->usOddSelection($us_odd);
        }

    }

    /*Adapter to store the values*/
    public function store($name, $uk_odd, $eu_odd, $us_odd)
    {


        if (!empty($uk_odd) && !empty($name)) {
            $this->ukOddInsert($uk_odd, $name);
        } elseif (!empty($eu_odd) && !empty($name)) {
            $this->euOddInsert($eu_odd, $name);
        } elseif (!empty($name) && !empty($us_odd)) {
            $this->usOddInsert($us_odd, $name);
        }

    }


    protected function ukOddSelection($uk_odd)
    {

        $pdo = Database::connect();
        $sql = "select EU,US from chart_values where UK =?";
        $query = $pdo->prepare($sql);
        $query->execute(array($uk_odd));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;

    }

    protected function euOddSelection($eu_odd)
    {
        $pdo = Database::connect();
        $sql = "select UK,US from chart_values where EU =?";
        $query = $pdo->prepare($sql);
        $query->execute(array($eu_odd));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;

    }

    protected function usOddSelection($us_odd)
    {
        $pdo = Database::connect();
        $sql = "select EU,UK from  chart_values where US =?";
        $query = $pdo->prepare($sql);
        $query->execute(array($us_odd));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;

    }


    protected function euOddInsert($eu_odd, $name)
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (name) values(?)";
        $query = $pdo->prepare($sql);
        $query->execute(array($name));


        /*Take the users_ID from database*/
        $user_id = null;
        $sql1 = "select userID from users where name =?";
        $query = $pdo->prepare($sql1);
        $query->execute(array($name));
        $result_id1 = $query->fetch(PDO::FETCH_ASSOC);

        foreach ($result_id1 as $key => $value) {

            $user_id = $value;

        }

        /*Take the chart_id of Chart table*/
        $value_id = null;
        $sql2 = "select chart_valuesID from chart_values where EU =?";
        $query = $pdo->prepare($sql2);
        $query->execute(array($eu_odd));
        $result_id2 = $query->fetch(PDO::FETCH_ASSOC);


        foreach ($result_id2 as $key => $value) {
            $value_id = $value;
        }

        if (isset($user_id) && isset($value_id)) {
            /*Now insert the values on history*/
            $sql3 = "INSERT INTO `history_values`(`user_value`, `chart_values_chart_valuesID`, `users_userID`) VALUES (?,?,?)";
            $query = $pdo->prepare($sql3);
            $query->execute(array($eu_odd, $value_id, $user_id));

            Database::disconnect();
        }/*else{
            echo " error.<br>";
            echo " the values user id is : $user_id.<br>";
            echo " the values value id is : $value_id.<br>";
        }*/


    }

    public function ukOddInsert($uk_odd, $name)
    {


        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (name) values(?)";
        $query = $pdo->prepare($sql);
        $query->execute(array($name));


        /*Take the users_ID from database*/
        $user_id = null;
        $sql1 = "select userID from users where name =?";
        $query = $pdo->prepare($sql1);
        $query->execute(array($name));
        $result_id1 = $query->fetch(PDO::FETCH_ASSOC);

        foreach ($result_id1 as $key => $value) {
            $user_id = $value;
        }

        /*Take the chart_id of Chart table*/

        $value_id = null;
        $sql2 = "select chart_valuesID from chart_values where UK =?";
        $query = $pdo->prepare($sql2);
        $query->execute(array($uk_odd));

        $result_id2 = $query->fetch(PDO::FETCH_ASSOC);


        foreach ($result_id2 as $key => $value) {
            $value_id = $value;
        }

        if (isset($user_id) && isset($value_id)) {

            $sql3 = "INSERT INTO `history_values`(`user_value`, `chart_values_chart_valuesID`, `users_userID`) VALUES (?,?,?)";
            $query = $pdo->prepare($sql3);
            $query->execute(array($uk_odd, $value_id, $user_id));

            Database::disconnect();
        }


    }


    protected function usOddInsert($us_odd, $name)
    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (name) values(?)";
        $query = $pdo->prepare($sql);
        $query->execute(array($name));


        /*Take the users_ID from database*/
        $user_id = null;
        $sql1 = "select userID from users where name =?";
        $query = $pdo->prepare($sql1);
        $query->execute(array($name));
        $result_id1 = $query->fetch(PDO::FETCH_ASSOC);

        foreach ($result_id1 as $key => $value) {

            $user_id = $value;


        }

        /*Take the chart_id of Chart table*/
        $value_id = null;
        $sql2 = "select chart_valuesID from chart_values where US =?";
        $query = $pdo->prepare($sql2);
        $query->execute(array($us_odd));
        $result_id2 = $query->fetch(PDO::FETCH_ASSOC);

        foreach ($result_id2 as $key => $value) {
            $value_id = $value;
        }


        if (isset($user_id) && isset($value_id)) {

            $sql3 = "INSERT INTO `history_values`(`user_value`, `chart_values_chart_valuesID`, `users_userID`) VALUES (?,?,?)";
            $query = $pdo->prepare($sql3);
            $query->execute(array($us_odd, $value_id, $user_id));

            Database::disconnect();
        }


    }


}
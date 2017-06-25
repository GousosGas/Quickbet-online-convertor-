<?php
require "Adapter.php";

/***
 * This function test if there is ajax request
 * @return bool
 */
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

        /***
         * Check for error in modal
         */

        if (empty($name)) {
            $valueError[] = "<div class=\"alert alert-danger\" role=\"alert\">Please enter your name </div>";
            $valid = false;
        }

        if (!empty($uk) && !empty($eu) && !empty($us)) {
            $valueError[] = "<div class=\"alert alert-danger\" role=\"alert\">Please give only one odd</div>";
            $valid = false;
         }

        if (!empty($uk) && !empty($eu)) {
            $valueError[] = "<div class=\"alert alert-danger\" role=\"alert\">Please give only one odd</div>";
            $valid = false;
        }

        if (!empty($uk) && !empty($us)) {
            $valueError[] = "<div class=\"alert alert-danger\" role=\"alert\">Please give only one odd</div>";
            $valid = false;
        }


        if (empty($uk) && empty($us) && empty($eu) && empty($name)) {
            $valueError[] = "<div class=\"alert alert-danger\" role=\"alert\">Please type your name and an odd.</div>";
        }

        if (!empty($valueError)) {
            $result_array = array('errors' => $valueError);
            echo json_encode($result_array);
            exit;
        }

        if ($valid) {

            $odds = new Adapter();
            $data = $odds->oddsSelection($uk, $eu, $us);
            $odds->store($name, $uk, $eu, $us);

            if (is_ajax_request()) {
                echo json_encode($data, JSON_PRETTY_PRINT);

            } else {
                exit;
            }
}
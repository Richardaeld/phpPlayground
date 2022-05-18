<?php

// set fetch OBJ
$api_data = 'https://dnd-rolling-chart-api.herokuapp.com/api/button/main/viewAll';
// Pull fetch OBJ
$json_data = file_get_contents($api_data,0,null,null);
// parse into PHP OBJECT
$response_data = json_decode($json_data);
// parse into PHP ARRAY
// $response_data_arr = json_decode($json_data, JSON_PRETTY_PRINT);
$response_data_arr = json_decode($json_data, true);
// slice into smaller array
// $parse_response_data = array_slice($response_data, 0, 1);

// print $json_data;
echo " <<--------------->> ";
// var_dump($response_data);
// print_r($response_data);

// Selects object and then the array
$test123 = $response_data->buttons;
print_r($response_data->buttons[0]);
echo " <<--------------->> ";
// echo gettype($response_data);
// echo $response_data;
// print $parse_response_data;

$arr = [1=>"I",2=>"am",3=>"here",4=>"breaking",5=>"through",6=>"the",7=>"walls"]

?>



<h1>
    <?php
        // $testarr = array($test123);
        $testarr = $test123;
        foreach($testarr as $key => $value) {
            // echo $key, $value;
            // print_r($value);
            // echo $value;
        }

        // print_r($response_data_arr);

        foreach($response_data_arr as $key => $value) {
            // echo "${$trend}";
            // echo $key;
        }

        // echo $response_data_arr->buttons[0];
        echo '<pre>';
        print_r($response_data -> buttons[0] -> name);
        // echo $response_data -> buttons[0][1];
        echo '</pre>';

        $test123 = $response_data->buttons;
        foreach($test123 as $key => $value) {
            if ($key === array_key_last($test123)) {
                echo $value -> name;
            } else {
                echo $value -> name, ", " ;
            }
        }


        foreach($response_data_arr as $value) {
            // echo $value;
        }


        // print_r($arr);
        // print_r($test123[1]);
        // foreach($arr as $key => $value) {
        //     echo $value;
        // }

    ?>
</h1>
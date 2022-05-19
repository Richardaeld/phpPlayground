<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>PHP Powered DM Dice Roll Tool</h1>
    <h2>Pick One Of Our Die or Input Your Own!</h2>
    <h3>
        <div class="col-11 mt-5 mx-2 py-4 index-background flex-content-center" style='color:black'>

            <?php
                // inital api call
                $api_dice = 'https://dnd-rolling-chart-api.herokuapp.com/api/button/main/viewAll/children/3';
                $json_api_dice = file_get_contents($api_dice);
                $dice_data = json_decode($json_api_dice);
                $dice_data -> button[2]  = new stdClass;
                $dice_data -> button[2] -> name  = "userInput";
                $dice_data -> button[2] -> obj_name  = "User input";
                $dice_data -> button[2] -> parent_foreign_key  = false;

                foreach($dice_data -> button as $key => $value) {
                    echo '<form action="get" class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                        $form_value = $value -> name;

                        echo "<input type='hidden' name='${form_value}' placeholder='${form_value}' value='${form_value}'>";
                        echo "<button class='hand-drawn-container-inner no-button' type='submit' name='level${form_value}' value='submit'>";
                            echo $value -> obj_name;
                        echo '</button>';
                    echo '</form>';
                }
            ?>
        </div>
    </h3>

    <h4>
        <div class="col-11 mt-5 mx-2 py-4 flex-content-center" style="color:black">
            <?php

                // echo '<pre>';
                //     print_r($dice_data -> button[2]);
                // echo '</pre>';

                foreach($dice_data -> button as $key => $value) {

                    if (isset($_GET[$value -> name])){

                        // print_r($value -> parent_foreign_key);
                        // print_r($value -> id);

                        if ($value -> name !== "userInput") {
                            $parent_key =  $value -> id;
                            $api_roll_content = "https://dnd-rolling-chart-api.herokuapp.com/api/button/sub/viewAll/children/${parent_key}";
                            $json_api_roll_content = file_get_contents($api_roll_content);
                            $roll_content_data = json_decode($json_api_roll_content);
                            $random_roll_num = mt_rand(0, count($roll_content_data -> button) - 1);
                            $random_roll_value = $roll_content_data -> button[$random_roll_num] -> value;
                            $random_roll_display_num = $random_roll_num + 1;
                        }

                        // print_r ($random_roll_value);

                        echo "<div class='container-fluid'>";
                            echo "<div class='row justify-content-center'>";
                                echo "<div class='col-11 col-md-6 output spell-display py-5'>";

                                if(isset($_GET["userInput"])) {
                                    echo "I am here";
                                    


                                    
                                } else {
                                    echo "<p class='spell-key mb-0'>You rolled a: ${random_roll_display_num}</p>";
                                    echo "<p class='mb-0'><strong>${random_roll_value}</strong></p>";

                                }

                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                }

            ?>
        </div>
    </h4>

</body>
</html>
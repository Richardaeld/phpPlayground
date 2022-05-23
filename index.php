<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DM Dice Roll Tool</title>
    <link rel="icon" href="favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <header class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="mt-4 header-text">PHP Powered DM Dice Roll Tool</h1>
            <h2 class="header-text">Pick A Table To Randomly Roll On or Input Your Own Roll!</h2>
            <div class="col-12 mt-5 mx-2 py-4 index-background flex-content-center" style='color:black'>
                <?php
                    // inital api call
                    $api_dice = 'https://dnd-rolling-chart-api.herokuapp.com/api/button/main/viewAll/children/3';
                    $json_api_dice = file_get_contents($api_dice);
                    $dice_data = json_decode($json_api_dice);

                    // Iterates over provided JSON objects
                    foreach($dice_data -> button as $key => $value) {
                        $form_value = $value -> name;
                        echo '<form class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                            echo "<input type='hidden' name='${form_value}' value='${form_value}'>";
                            echo "<button class='hand-drawn-container-inner no-button' type='submit' name='level${form_value}' value='submit'>";
                                echo $value -> obj_name;
                            echo '</button>';
                        echo '</form>';
                    }
                ?>
            </div>
        </div>
    </header>

    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 mt-5 py-4 flex-content-center" style="color:black">
                    <?php
                        foreach($dice_data -> button as $key => $value) {
                            // Removes/add output container if there is output
                            if (isset($_GET[$value -> name]) || isset($_GET["user".$value -> name]) ){
                                // API call
                                $parent_key =  $value -> id;
                                $api_roll_content = "https://dnd-rolling-chart-api.herokuapp.com/api/button/sub/viewAll/children/${parent_key}";
                                $json_api_roll_content = file_get_contents($api_roll_content);
                                $roll_content_data = json_decode($json_api_roll_content);

                                // Allows random or user input to be displayed
                                if (isset($_GET["user".$value -> name])) {
                                    $random_roll_num = $_GET["userRoll".$value -> name] - 1;
                                } else {
                                    $random_roll_num = mt_rand(0, count($roll_content_data -> button) - 1);
                                }
                                // Sets roll value and roll num to be displayed in user friendly form
                                $random_roll_value = $roll_content_data -> button[$random_roll_num] -> value;
                                $random_roll_display_num = $random_roll_num + 1;
                                // Sets a table length max and table name
                                $maxCount = count($roll_content_data -> button);
                                $form_value = $value -> name;

                                echo "<div class='container-fluid'>";
                                    echo "<div class='row justify-content-between'>";
                                        // Form allowing user input
                                        echo "<div class='col-12 col-md-5 output spell-display py-5 order-1 order-xl-0'>";
                                            echo "<p class='d-block mb-0'><strong>Slide your DM your new roll?</strong></p>";
                                            echo "<p class='d-block mb-0'><strong>Submit your D${maxCount} Roll</strong></p>";
                                            echo '<form class="mt-5 p-1 row nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                                                echo "<input class='col-12 input-border' type='number' name='userRoll${form_value}' placeholder='7' value='1' min='1' max='${maxCount}' required>";
                                                echo "<button class='col-12  user-input-button' type='submit' name='user${form_value}' value='submit'>";
                                                    echo 'Submit';
                                                echo '</button>';
                                            echo '</form>';
                                        echo "</div>";
                                        // Roll results
                                        $table_name = $value -> obj_name;
                                        echo "<div class='col-12 col-md-6 output spell-display py-5 order-0 order-xl-1 flex-content-center'>";
                                            echo "<div class='row'>";
                                                echo "<p class='col-12'><strong>${table_name} Table:</strong></p>";
                                                echo "<div class='col-12'>";
                                                    echo "<p class='spell-key mb-0'>You rolled a: ${random_roll_display_num}</p>";
                                                    echo "<p class='mb-0'><strong>${random_roll_value}</strong></p>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
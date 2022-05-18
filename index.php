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








<h1>PHP Powered DM Tool</h1>
<h2>Pick a level to start your spell search</h2>

<?php
    // Api locations and variables
    // $spell_level = 0;
    $spell_id = 0;
    $api_levels = 'https://dnd-rolling-chart-api.herokuapp.com/api/button/main/viewAll/children/5';
    // $api_spells = "https://dnd-rolling-chart-api.herokuapp.com/api/spells/spellsByLevel/${spell_level}";
    $api_spell = "https://dnd-rolling-chart-api.herokuapp.com/api/spells/spellById/${spell_id}";



?>

<h3>
    <div class="col-11 mt-5 mx-2 py-4 index-background flex-content-center">

        <?php
            // inital api call
            $json_api_levels = file_get_contents($api_levels);
            $levels_data = json_decode($json_api_levels);
            foreach($levels_data -> button as $key => $value) {
                echo '<form action="get" class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                    $form_value = $value -> name;
                    echo $form_value = $form_value[-1];
                    echo "<input type='hidden' name='lvl${form_value}' placeholder='${form_value}' value='${form_value}'>";
                    echo "<button class='hand-drawn-container-inner no-button' type='submit' name='submit${form_value}' value='submit'>";
                        echo $value -> obj_name;
                    echo '</button>';
                echo '</form>';

            }

        ?>
    </div>
</h3>

<h4>
    <div class="col-11 mt-5 mx-2 py-4 index-backgroun-d flex-content-center" style="background-color: orange;">
        <?php
            $test123 = 1;

            
            $spell_level= 0;
            if (isset($_GET['submit1'])) {
                $test123 = $_GET['lvl1'];
                echo "<h1 style='color:black'>${test123}</h1>";
                if (!($spell_level)) {
                    $spell_level = 0;
                }
                // $api_spells = "https://dnd-rolling-chart-api.herokuapp.com/api/spells/spellsByLevel/${spell_level}";
                // $json_api_spells = file_get_contents($api_spells);
                // $spells_data = json_decode($json_api_spells);

                // echo '<h1 style="color:black"> I AM HERE </h1>';
            }

        ?>
    </div>
</h4>



</body>
</html>
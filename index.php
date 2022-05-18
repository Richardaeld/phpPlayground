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
    <h2>Pick a Dice or input your own!</h2>

    <?php
        // $spell_id = 0;
        $api_dice = 'https://dnd-rolling-chart-api.herokuapp.com/api/button/main/viewAll/children/1';
    ?>

    <h3>
        <div class="col-11 mt-5 mx-2 py-4 index-background flex-content-center">

            <?php
                // inital api call
                $json_api_dice = file_get_contents($api_dice);
                $dice_data = json_decode($json_api_dice);
                foreach($dice_data -> button as $key => $value) {
                    echo '<form action="get" class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                        $form_value = $value -> name;
                        // echo $form_value = $form_value[-1];
                        echo "<input type='hidden' name='lvl${form_value}' placeholder='${form_value}' value='${form_value}'>";
                        echo "<button class='hand-drawn-container-inner no-button' type='submit' name='level${form_value}' value='submit'>";
                            echo $value -> obj_name;
                        echo '</button>';
                    echo '</form>';

                }

            ?>
        </div>
    </h3>

    <h4>
        <div class="col-11 mt-5 mx-2 py-4 index-background flex-content-center" style="color:black">
            <?php
                // foreach($levels_data -> button as $key => $value) {
                //     if (isset($_GET["level${key}"])){
                //         $api_spells = "https://dnd-rolling-chart-api.herokuapp.com/api/spells/spellsByLevel/${key}";
                //         $json_api_spells = file_get_contents($api_spells);
                //         $spells_data = json_decode($json_api_spells);

                //         foreach($spells_data -> spells as $spell_key => $spell_value) {
                //             $spell_name = $spell_value -> name;
                //             $spell_id = $spell_value -> id;
                //             echo '<form action="get" class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                //                 echo "<input type='hidden' name='spell${spell_id}' placeholder='${spell_id}' value='${spell_id}'>";

                //                 echo "<button class='hand-drawn-container-inner no-button' type='submit' name='spell${spell_id}' value='submit'>";
                //                     echo $spell_name;
                //                 echo '</button>';
                //             echo '</form>';
                //         }
                //     }
                // }
            ?>
        </div>
    </h4>

    <h5>

    </h5>



</body>
</html>
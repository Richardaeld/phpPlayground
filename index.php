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
                foreach($levels_data -> button as $key => $value) {
                    if (isset($_GET["level${key}"])){
                        $api_spells = "https://dnd-rolling-chart-api.herokuapp.com/api/spells/spellsByLevel/${key}";
                        $json_api_spells = file_get_contents($api_spells);
                        $spells_data = json_decode($json_api_spells);

                        foreach($spells_data -> spells as $spell_key => $spell_value) {
                            $spell_name = $spell_value -> name;
                            $spell_id = $spell_value -> id;
                            echo '<form action="get" class="nonselectable hand-drawn-text hand-drawn-container-outer hand-drawn-border ">';
                                echo "<input type='hidden' name='spell${spell_id}' placeholder='${spell_id}' value='${spell_id}'>";

                                echo "<button class='hand-drawn-container-inner no-button' type='submit' name='spell${spell_id}' value='submit'>";
                                    echo $spell_name;
                                echo '</button>';
                            echo '</form>';
                        }
                    }
                }
            ?>
        </div>
    </h4>

    <h5>

    <div class="container-fluid mt-5" id="spell-description">
    <div class="row justify-content-center">
            <div class="col-11 spell-display">
                <div class="row my-4 mx-3">
                    <div class="col-12">
                        <div class="row justify-content-around">

                        <?php

                            $api_all_spells = "https://dnd-rolling-chart-api.herokuapp.com/api/spells";
                            $json_api_all_spells = file_get_contents($api_all_spells);
                            $all_spells_data = json_decode($json_api_all_spells);
                            // print_r($all_spells_data -> spells[0] -> name)
                            echo count($all_spells_data -> spells);

                            foreach($all_spells_data -> spells as $key => $value) {
                                $spell_name = $value -> name;
                                $spell_id = $value -> id;

                                if (isset($_GET["spell${spell_id}"])){
                                    echo "<h1>${spell_name}</h1>";
                                }
                                // echo $value -> name;
                                // print_r($spells -> name);
                            }

                            // if (isset($_GET["spell${spell_name}"])){
                            // }
                        ?>


                            <!-- Spell Name -->
                            <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Name</p>
                                <p><strong>{props.name}</strong></p>
                            </div>

                            <!-- Spell Level -->
                            <!-- <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Level</p>
                                {props.level === 0 &&<p><strong>Cantrip</strong></p>}
                                {props.level !== 0 &&<p><strong>Level {props.level}</strong></p>}
                            </div> -->

                            <!-- Spell Casting Time -->
                            <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Casting Time</p>
                                <p><strong>{props.castingTime}</strong></p>
                            </div>

                            <!-- Spell Reaction Condition if exists -->
                            <!-- {props.reaction_condition &&
                                <div class="col-12">
                                    <p class="mb-0 spell-key">Reaction Condition</p>
                                    <p><strong>{props.reaction_condition}</strong></p>
                                </div>
                            } -->

                            <!-- Spell Range -->
                            <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Range</p>
                                <p><strong>{props.range}</strong></p>
                            </div>

                            <!-- Spell Duration -->
                            <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Duration</p>
                                <p><strong>{props.duration}</strong></p>
                            </div>

                            <!-- Spell Ritual -->
                            <!-- <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Ritual</p>
                                {props.ritual && <p><strong>True</strong></p>}
                                {!props.ritual && <p><strong>False</strong></p>}
                            </div> -->

                            <!-- Spell Somatic -->
                            <!-- <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Somatic</p>
                                {props.component_somatic && <p><strong>True</strong></p>}
                                {!props.component_somatic && <p><strong>False</strong></p>}
                            </div> -->

                            <!-- Spell Verbal -->
                            <!-- <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Verbal</p>
                                {props.component_verbal && <p><strong>True</strong></p>}
                                {!props.component_verbal && <p><strong>False</strong></p>}
                            </div> -->

                            <!-- Spell Material -->
                            <!-- <div class="col-6 col-md-4">
                                <p class="mb-0 spell-key">Material</p>
                                {props.component_material && <p><strong>True</strong></p>}
                                {!props.component_material && <p><strong>False</strong></p>}
                            </div> -->

                            <!-- Spell Material Description if exist -->
                            <!-- {props.material_description &&
                                <div class="col-12">
                                    <p class="mb-0 spell-key">Material Description</p>
                                    {props.material_description && <p><strong>{props.material_description}</strong></p>}
                                </div>
                            } -->

                            <!-- Spell Description -->
                            <div class="col-12">
                                <p class="mb-0 spell-key">Description</p>
                                <p><strong>{props.description}</strong></p>
                            </div>

                            <!-- Spell Higher Level Description if exists -->
                            <!-- { props.higher_levels &&
                                <div class="col-12">
                                    <p class="mb-0 spell-key">Higher Level</p>
                                    <p><strong>{props.higher_levels}</strong></p>
                                </div>
                            } -->

                            <!-- Spell School -->
                            <div class="col-6 col-md-2">
                                <p class="mb-0 spell-key">School</p>
                                <p><strong>{props.school}</strong></p>
                            </div>

                            <!-- Spell available to Classes -->
                            <div class="col-6 col-md-2">
                                <p class="mb-0 spell-key">classes</p>
                                <p><strong>{props.classes}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </h5>



</body>
</html>
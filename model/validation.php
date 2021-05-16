<?php

/* validation.php
 * Validate data for the diner app
 *
 */

//Return true if name is valid
function validFood($name)
{
    return strlen(trim($name)) >= 2;
}

//Return true if *all* choices are valid
function validChoices($choices)
{
    $validChoices = getChoices();

    //Make sure each selected choices is valid
    foreach ($choices as $userChoice) {
        if (!in_array($userChoice, $validChoices)) {
            return false;
        }
    }

    //All choices are valid
    return true;
}
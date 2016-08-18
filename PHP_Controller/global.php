<?php

function safe_input($string, $escape)
{
    $string = preg_replace("[^A-Za-z0-9@." . $escape . "]", "", $string);
    return $string;
}
?>
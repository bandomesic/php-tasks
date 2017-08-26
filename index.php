<?php

include('functions.php');

/*
 * 1. Task - isAnagram
 */

echo '<h2>1. Task - isAnagram</h2>';

$string1 = 'AstroNomers';
$string2 = 'no more stars';

echo '<p><b>' . $string1 . '</b> anagram of <b>' . $string2 . '</b> = <b> ' . var_export(isAnagram($string1, $string2), true) . ' </b></p>';
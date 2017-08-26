<?php

if (! function_exists('isAnagram')) {
    /**
     * 1. Task
     *
     * Check if two input strings form anagrams of each other
     *
     * @param string $string1
     * @param string $string2
     * @return bool
     */
    function isAnagram($string1, $string2)
    {
        $string1 = cleanUpString($string1);
        $string2 = cleanUpString($string2);

        if (count($string1) != count($string2)) {
            return false;
        }

        foreach ($string1 as $char) {
            if (!in_array($char, $string2)) {
                return false;
            }
        }

        return true;
    }
}

if (! function_exists('cleanUpString')) {
    /**
     * Transform characters to lowercase, remove whitespace and convert a string to an array
     *
     * @param string $string
     * @return array
     */
    function cleanUpString($string)
    {
        return str_split(preg_replace('/\s+/', '', strtolower($string)));
    }
}
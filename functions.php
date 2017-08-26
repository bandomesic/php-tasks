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
        $string1 = str_split(cleanUpString($string1));
        $string2 = str_split(cleanUpString($string2));

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
     * Transform characters to lowercase and remove whitespace from string
     *
     * @param string $string
     * @return array
     */
    function cleanUpString($string)
    {
        return preg_replace('/\s+/', '', strtolower($string));
    }
}

if (! function_exists('isAnagramGoogleWay')) {
    /**
     * 1. Task (Google way)
     *
     * @param string $string1
     * @param string $string2
     * @return bool
     */
    function isAnagramGoogleWay($string1, $string2) {
        return(count_chars(cleanUpString($string1), 1) == count_chars(cleanUpString($string2), 1));
    }
}
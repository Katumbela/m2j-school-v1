<?php

namespace App\Utils;

class StringUtils
{
    public static function getAcronym($string)
    {
        $words = explode(' ', $string);
        $acronym = '';
        $ignoreWords = ['de', 'e'];
        
        foreach ($words as $word) {
            if (!empty($word) && !in_array(strtolower($word), $ignoreWords)) {
                $acronym .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return $acronym;
    }
} 
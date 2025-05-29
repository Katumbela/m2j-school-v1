<?php

namespace App\Utils;

class StringUtils
{
    public static function getAcronym($string)
    {
        $words = explode(' ', $string);
        $acronym = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $acronym .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return $acronym;
    }
} 
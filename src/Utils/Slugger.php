<?php
/**
 * Created by BChar
 * Date: 21/07/2018
 * Time: 22:56
 */
namespace App\Utils;


class Slugger
{
    // Remplacement des espaces par des tirets, forcer en miniscule, suppression des espaces en D et F de chaîne et
    // des balises HTML et PHP.
    public static function slugify(string $string): string
    {
        return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
    }
}
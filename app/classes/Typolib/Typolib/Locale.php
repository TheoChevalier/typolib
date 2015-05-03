<?php
namespace Typolib;

class Locale
{
    private $locale_list = ['fr', 'en', 'es', 'ro'];

    public static function getLocaleList()
    {
        return $locale_list;
    }

    public static function isSupportedLocale($locale)
    {
        if (in_array($locale, $locale_list)) {
            return true;
        } else {
            return false;
        }
    }
}

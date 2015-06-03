<?php
namespace Typolib;

class Locale
{
    private static $locale_list = ['fr', 'en', 'es', 'ro'];

    public static function getLocaleList()
    {
        $locales = self::$locale_list;
        asort($locales);

        return $locales;
    }

    public static function isSupportedLocale($locale)
    {
        return in_array($locale, self::$locale_list);
    }
}

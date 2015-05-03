<?php
namespace Typolib;

class Code
{
    public $code_id;
    public $code_name;
    public $code_locale;
    public $array;

    public function __construct($name, $locale)
    {
        $directory = DATA_ROOT . "code/$locale";
        if (! is_dir($directory)) {
            mkdir($directory);
        }
        $directory = DATA_ROOT . "code/$locale/$name";
        if (! is_dir($directory)) {
            mkdir($directory);
            fopen("$directory/rules.php", 'w');
            fopen("$directory/exceptions.php", 'w');
        }
    }
}

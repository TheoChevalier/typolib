<?php
namespace Typolib;

class Code
{
    public $code_id;
    public $code_name;
    public $code_locale;

    public $allIds;

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

    public static function generateCodeId()
    {
        $array = Code::scanDirectory(DATA_ROOT . 'code');
        $id = max($array);

        return ++$id;
    }

    /**
     * Scans the directory and for each sub-directory gets the code id
     *
     * @param  String $dir The path of the directory which has to be scanned.
     * @return array  $allIds contains all the code's id
     */
    public static function scanDirectory($dir)
    {
        global $allIds;
        $filetype = filetype($dir);

        // If $dir is a directory
        // => calls scanDirectory() for each file or directory
        if (is_dir($dir)) {
            $me = opendir($dir);
            while ($child = readdir($me)) {
                if ($child != '.' && $child != '..' && is_dir($dir . DIRECTORY_SEPARATOR . $child)) {
                    $id = explode("-", $child);
                    if (is_numeric($id[0])) {
                        $allIds[] = $id[0];
                    }
                    Code::scanDirectory($dir . DIRECTORY_SEPARATOR . $child);
                }
            }
        }

        return $allIds;
    }
}

<?php
namespace Typolib;

/**
 * Utils class
 *
 * @package Typolib
 */
class Utils
{
    public static function sanitizeFileName($name)
    {
        $name = str_replace(' ', '_', $name);

        return preg_replace('/[^a-zA-Z0-9-_\.]/', '#', $name);
    }

    public static function deleteFolder($folder)
    {
        if (is_dir($folder)) {
            $objects = scandir($folder);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($folder . '/' . $object) == 'dir') {
                        Utils::deleteFolder($folder . '/' . $object);
                    } else {
                        unlink($folder . '/' . $object);
                    }
                }
            }
            reset($objects);
            rmdir($folder);

            return true;
        }

        return false;
    }

    /**
     * Closes the connection with the browser so that we can do things in the
     * background
     */
    public static function closeConnection()
    {
        header("Connection: close");
        ignore_user_abort(true);
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();
        flush();
    }
}

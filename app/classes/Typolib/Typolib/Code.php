<?php
namespace Typolib;

use Exception;

/**
 * Code class
 *
 * This class provides methods to manage a code: create, delete or update,
 * check if a code exists.
 *
 * @package Typolib
 */
class Code
{
    private $name;
    private $fake_name;
    private $locale;
    private $path;
    private $use_common_code;
    private static $code_list = [];

    /**
     * Constructor that initializes all the arguments then call the method
     * to create the code if the locale is supported.
     *
     * @param  String    $name            The name of the new code.
     * @param  String    $locale          The locale of the new code.
     * @param  boolean   $use_common_code True if the code must use the common
     *                                    code of the locale.
     * @throws Exception if code creation failed.
     */
    public function __construct($name, $locale, $use_common_code)
    {
        $success = false;
        if (Locale::isSupportedLocale($locale)) {
            $this->name = \Transvision\Utils::secureText($name);
            $this->locale = $locale;
            $this->fake_name = Utils::sanitizeFileName($this->name);
            if ($this->fake_name != 'common') {
                $this->path = DATA_ROOT . RULES_STAGING . "/$this->locale/$this->fake_name";
                $this->use_common_code = $use_common_code;

                if ($this->createCode()) {
                    $this->name = 'common';
                    if (! is_dir(DATA_ROOT . RULES_STAGING . "/$this->locale/$this->name")) {
                        $this->path = DATA_ROOT . RULES_STAGING . "/$this->locale/$this->name";
                        $this->createCode();
                    }
                    $success = true;
                }
            }
        }

        if (! $success) {
            throw new Exception('Code creation failed.');
        }
    }

    /**
     * Creates a code, its directory and its files (rules.php and exceptions.php).
     *
     * @return boolean True if the code doesn't exist and has been created.
     */
    private function createCode()
    {
        if (! file_exists($this->path)) {
            $code = ['name' => $this->name];

            if ($this->name != 'common') {
                $code['common'] = $this->use_common_code;
            }
            $path = $this->path;

            $repo_mgr = new RepoManager();
            $repo_mgr->checkForUpdates();

            mkdir($path, 0777, true);

            file_put_contents($path . '/rules.php', serialize($code));
            file_put_contents($path . '/exceptions.php', '');

            $repo_mgr->commitAndPush('Adding "' . $this->fake_name . '" code.');

            return true;
        }

        return false;
    }

    /**
     * Deletes a code. Calls deleteFolder method to delete all the files related
     * to the code.
     *
     * @param  String  $name   The name of the code to delete.
     * @param  String  $locale The locale of the code to delete.
     * @return boolean True if the function succeeds.
     */
    public static function deleteCode($name, $locale)
    {
        $folder = DATA_ROOT . RULES_STAGING . "/$locale/$name";

        $repo_mgr = new RepoManager();
        $repo_mgr->checkForUpdates();
        if (Utils::deleteFolder($folder)) {
            $repo_mgr->commitAndPush('Deleting "' . $name . '" code.');

            return true;
        }

        return false;
    }

    /**
     * Allows editing a code name and tell if it should be using the common code.
     *
     * @param String  $old_name        The current name of the code to edit.
     * @param String  $new_name        The new code name
     * @param String  $locale          The locale of the code to edit.
     * @param boolean $use_common_code true if the code should be using the
     *                                 common code of this locale. False if it
     *                                 should not be using any common code.
     */
    public static function editCode($old_name, $new_name, $locale, $use_common_code)
    {
        $folder = DATA_ROOT . RULES_STAGING . "/$locale/$old_name";
        if ($old_name != 'common' && self::existCode($old_name, $locale, RULES_STAGING)) {
            $content = Rule::getArrayRules($old_name, $locale, RULES_STAGING);
            $content['name'] = \Transvision\Utils::secureText($new_name);
            $content['common'] = $use_common_code;

            $repo_mgr = new RepoManager();
            $repo_mgr->checkForUpdates();

            file_put_contents($folder . '/rules.php', serialize($content));

            $repo_mgr->commitAndPush('Editing "' . $new_name . '" code.');
        }
    }

    /**
     * Check if the code exists in the rule repository.
     *
     * @param  String  $name   The name of the code we search.
     * @param  String  $locale The locale of the code we search.
     * @param  String  $repo   Repository we want to check (staging or production)
     * @return boolean True if the code exists.
     */
    public static function existCode($name, $locale, $repo)
    {
        $folder = DATA_ROOT . $repo . "/$locale/$name";

        return file_exists($folder);
    }

    /**
     * List all the available codes for a given locale.
     *
     * @param  String $locale The locale of the codes we search.
     * @param  String $repo   Repository we want to check (staging or production)
     * @return array  The list of all the codes for the locale.
     */
    public static function getCodeList($locale, $repo)
    {
        if (Locale::isSupportedLocale($locale)) {
            $dir = DATA_ROOT . $repo . "/$locale";
            $list = self::scanDirectory($dir);
            natcasesort($list);

            return $list;
        } else {
            return false;
        }
    }

    /**
     * Scan a directory to find the name of all the codes in it.
     *
     * @param  String $dir The path directory we want to scan.
     * @return array  $code_list The list of all the corresponding codes
     *                    (key: the name of the folder,
     *                    value: the real name of the code).
     */
    private static function scanDirectory($dir)
    {
        if (is_dir($dir)) {
            $me = opendir($dir);
            while ($child = readdir($me)) {
                if ($child != '.' && $child != '..') {
                    $folder = $dir . DIRECTORY_SEPARATOR . $child;
                    if ($child == 'rules.php') {
                        $code = unserialize(file_get_contents($folder));
                        self::$code_list[basename($dir)] = $code['name'];
                    }
                    self::scanDirectory($folder);
                }
            }
            unset($code);
        }

        return self::$code_list;
    }

    /**
     * Import a code.
     *
     * @param String $code_name        The name of the code where we want to
     *                                 import.
     * @param String $locale_code      The locale of the code where we want to
     *                                 import.
     * @param String $code_name_import The name of the imported code.
     * @param array  $selected_rules   All the ids of the rules we want to export,
     *                                 if empty we import all the rules.
     * @param String $repo             Repository of the code we want import
     *                                 (staging or production)
     */
    public static function importCode($code_name, $locale_code, $code_name_import, $selected_rules = '', $repo)
    {
        $repo_mgr = new RepoManager();
        $repo_mgr->checkForUpdates();

        $new_rule_exceptions = [];

        $rule_file = DATA_ROOT . $repo . "/$locale_code/$code_name/rules.php";
        $exception_file = DATA_ROOT . $repo . "/$locale_code/$code_name/exceptions.php";

        $rules = Rule::getArrayRules($code_name, $locale_code, $repo);
        $exceptions = RuleException::getArrayExceptions($code_name, $locale_code, $repo);
        $rules_to_import = Rule::getArrayRules($code_name_import, $locale_code, $repo);
        $exceptions_to_import = RuleException::getArrayExceptions($code_name_import, $locale_code, $repo);

        $has_exceptions = false;

        if ($exceptions_to_import != false && array_key_exists('exceptions', $exceptions_to_import)) {
            $has_exceptions = true;
        }

        if ($rules_to_import != false && array_key_exists('rules', $rules_to_import)) {
            if ($rules != false) {
                $selected_rules = empty($selected_rules)
                                    ? array_keys($rules_to_import['rules'])
                                    : $selected_rules;

                foreach ($rules_to_import['rules'] as $id => $rule) {
                    if (in_array($id, $selected_rules)) {
                        $comment = array_key_exists('comment', $rule) ? $rule['comment'] : '';
                        $rules['rules'][] = [
                                                'content' => $rule['content'],
                                                'type'    => $rule['type'],
                                            ];

                        //Get the last inserted id
                        end($rules['rules']);
                        $rule_id = key($rules['rules']);

                        if ($comment != '') {
                            $rules['rules'][$rule_id]['comment'] = $comment;
                        }

                        if ($has_exceptions) {
                            $new_rule_exceptions[$rule_id] = Rule::getRuleExceptions($exceptions_to_import, $id);
                        }
                    }
                }
            }
            if ($rules != Rule::getArrayRules($code_name, $locale_code, $repo)) {
                file_put_contents($rule_file, serialize($rules));

                $repo_mgr->commitAndPush("Importing rules in /$locale_code/$code_name");
            }
        }

        if (! empty($new_rule_exceptions)) {
            foreach ($new_rule_exceptions as $id_rule => $exception) {
                foreach ($exception as $id_exception => $content) {
                    $exceptions['exceptions'][] = ['rule_id' => $id_rule,
                                                   'content' => $content, ];
                }
            }

            if ($exceptions != RuleException::getArrayExceptions($code_name, $locale_code, $repo)) {
                file_put_contents($exception_file, serialize($exceptions));

                $repo_mgr->commitAndPush("Importing exceptions in /$locale_code/$code_name");
            }
        }
    }
}

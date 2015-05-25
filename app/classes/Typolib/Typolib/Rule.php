<?php
namespace Typolib;

use Exception;
use Transvision\Strings;

/**
 * Rule class
 *
 * This class provides methods to manage a rule: create, delete or update,
 * check if a rule exists and get all the rules for a specific code.
 *
 * @package Typolib
 */
class Rule
{
    private $id;
    private $content;
    private $type;
    private $comment;
    // FIXME: string?
    private static $rules_type = ['if_then'     => 'IF […] THEN […]',
                                  'contains'    => 'CONTAINS […]',
                                  'string'      => 'STRING',
                                  'starts_with' => 'STARTS WITH […]',
                                  'ends_with'   => 'ENDS WITH […]', ];
    private static $ifThenRuleArray = [];
    private static $variable_to_ignore_array = [];
    private static $start_variable_tag = '<-';
    private static $end_variable_tag = '->';
    private static $plural_separator_array = [];
    private static $all_ids = [];

    /**
     * Constructor that initializes all the arguments then call the method to
     * create the rule if the code exists.
     *
     * @param  String  $name_code   The code name from which the rule depends.
     * @param  String  $locale_code The locale code from which the rule depends.
     * @param  String  $content     The content of the new rule.
     * @param  String  $type        The type of the new rule.
     * @param  String  $comment     The comment of the new rule.
     * @return boolean True if the rule has been created.
     */
    public function __construct($name_code, $locale_code, $content, $type, $comment = '')
    {
        $success = false;

        if (Code::existCode($name_code, $locale_code) && self::isSupportedType($type)) {
            $this->content = $content;
            $this->type = $type;
            $this->comment = $comment;
            $this->createRule($name_code, $locale_code);
            $success = true;
        }

        if (! $success) {
            throw new Exception('Rule creation failed.');
        }
    }

    /**
     * Creates a rule into the rules.php file located inside the code directory.
     *
     * @param String $name_code   The code name from which the rule depends.
     * @param String $locale_code The locale code from which the rule depends.
     */
    private function createRule($name_code, $locale_code)
    {
        $file = DATA_ROOT . RULES_REPO . "/$locale_code/$name_code/rules.php";
        $code = Rule::getArrayRules($name_code, $locale_code);
        $code['rules'][] = [
                                'content' => $this->content,
                                'type'    => $this->type,
                            ];

        //Get the last inserted id
        end($code['rules']);
        $this->id = key($code['rules']);

        if ($this->comment != '') {
            $code['rules'][$this->id]['comment'] = $this->comment;
        }

        file_put_contents($file, serialize($code));
    }

    /**
     * Allows deleting a rule, or updating the content or the type of a rule.
     *
     * @param  String  $name_code   The code name from which the rule depends.
     * @param  String  $locale_code The locale code from which the rule depends.
     * @param  integer $id          The identity of the rule.
     * @param  String  $action      The action to perform: 'delete', 'update_content',
     *                              'update_type' or 'update_comment'.
     * @param  String  $value       The new content or type of the rule. If action
     *                              is 'delete' the value must be empty.
     * @return boolean True if the function succeeds.
     */
    public static function manageRule($name_code, $locale_code, $id, $action, $value = '')
    {
        $file = DATA_ROOT . RULES_REPO . "/$locale_code/$name_code/rules.php";

        $code = Rule::getArrayRules($name_code, $locale_code);
        if ($code != null && Rule::existRule($code, $id)) {
            switch ($action) {
                case 'delete':
                    unset($code['rules'][$id]);
                    break;

                case 'update_content':
                    $code['rules'][$id]['content'] = $value;
                    break;

                case 'update_type':
                    if (self::isSupportedType($value)) {
                        $code['rules'][$id]['type'] = $value;
                    } else {
                        return false;
                    }
                    break;
                case 'update_comment':
                    $code['rules'][$id]['comment'] = $value;
                    break;
            }
            file_put_contents($file, serialize($code));

            return true;
        }

        return false;
    }

    /**
     * Check if the rule exists in a rules array.
     *
     * @param  array   $code The array in which the rule must be searched.
     * @param  integer $id   The identity of the rule we search.
     * @return boolean True if the rule exists
     */
    public static function existRule($code, $id)
    {
        return array_key_exists($id, $code['rules']);
    }

    /**
     * Get an array of all the rules for a specific code.
     *
     * @param String $name_code   The code name from which the rules depend.
     * @param String $locale_code The locale code from which the rules depend.
     */
    public static function getArrayRules($name_code, $locale_code)
    {
        if (Code::existCode($name_code, $locale_code)) {
            $file = DATA_ROOT . RULES_REPO . "/$locale_code/$name_code/rules.php";

            return unserialize(file_get_contents($file));
        }
    }

    /**
     * Add a "if x then y" rule to the global array
     *
     * @param string $userString the string entered by the user
     */
    public function addRuleToIfThenArrayRule($userString)
    {
        $pieces = explode(' ', $userString);
        $inputCharacter = $pieces[1];
        $newCharacter = $pieces[3];

        self::$ifThenRuleArray[$inputCharacter] = $newCharacter; // if a value with the same key is added, the previous value will be replaced by the new one
    }

    /**
     * Display all the rules of the "if then" array
     */
    public static function displayIfThenArrayRule()
    {
        foreach (self::$ifThenRuleArray as $key => $value) {
            echo "Input character: $key => New character: $value<br />\n";
        }
    }

    /**
     * Check a "if x then y" rule (just for ellipsis character)
     *
     * @param string $userString the string entered by the user
     */
    public static function checkIfThenRuleEllipsis($userString, $mode)
    {
        $res = []; // var to be returned
        $searchs = self::$ifThenRuleArray;
        $positions = []; // array containing the positions of the errors detected in the source string

        foreach ($searchs as $search => $replace) {
            $last_position = 0;

            // save all the positions of the errors
            while (($last_position = strpos($userString, $search, $last_position)) !== false) {
                $$next_position = $last_position + strlen($search);
                $positions[$last_position] = $$next_position;
                $last_position = $$next_position;
            }

            // replace all the errors by the characters entered by the user
            if (strpos($userString, $search) !== false) {
                $userString = str_replace($search, $replace, $userString);
            }
        }

        array_push($res, $userString);
        array_push($res, $positions);

        return $res;
    }

    /**
     * Add a variable to the global array of variables to ignore
     *
     * @param string $userString the string entered by the user
     */
    public static function addRuleToVariableToIgnoreArray($userString)
    {
        $var_array = preg_split('/[\s]+/', $userString);

        self::$variable_to_ignore_array = array_merge(self::$variable_to_ignore_array, $var_array);

        //self::$variable_to_ignore_array[$userString] = self::$start_variable_tag . $userString . self::$end_variable_tag;
    }

    /**
     * Display all the rules of the global array of variables to ignore
     */
    public static function displayVariableToIgnoreArray()
    {
        foreach (self::$variable_to_ignore_array as $key => $value) {
            echo "Variable to ignore: $key<br />\n";
        }
    }

    /**
     * Add a separator to the global array of plural separators
     *
     * @param string $userString the string entered by the user
     */
    public static function addRuleToPluralSeparatorArray($userString)
    {
        self::$plural_separator_array[] = $userString;
    }

    /**
     * Display all the rules of the global array of plural separators
     */
    public static function displayPluralSeparatorArray()
    {
        foreach (self::$plural_separator_array as $key => $value) {
            echo "Plural separator: $value<br />\n";
        }
    }

    public static function checkSeparatorRule($userString)
    {
        foreach (self::$plural_separator_array as $key => $separator) {
            $pos = strpos($userString, $separator);

            if ($pos !== false) {
                //$separator = ';';
                $splitStrings = explode($separator, $userString);
                $levenshteinResults = [];
                $acceptanceLevel = 90;

                $arr_length = count($splitStrings);
                for ($i = 0;$i < $arr_length;$i++) {
                    if ($i + 1 < $arr_length) {
                        $levenshteinResults[] = Strings::levenshteinQuality($splitStrings[$i], $splitStrings[$i + 1]);
                    }
                }

                $levenshteinResultsAverage = 0;

                foreach ($levenshteinResults as $key => $value) {
                    $levenshteinResultsAverage += $value;
                }

                $levenshteinResultsAverage = $levenshteinResultsAverage / count($levenshteinResults);

                if ($levenshteinResultsAverage > $acceptanceLevel) {
                    $userString = str_replace($separator, $start_variable_tag . $separator . $end_variable_tag, $userString);
                }
            }
        }

        return $userString;
    }

    /**
     * Ignore all the variables of the variable_to_ignore_array in the user string
     *
     * @param string $userString the string entered by the user
     */
    public static function ignoreVariables($userString)
    {
        strtr($userString, $variable_to_ignore_array);
    }

    /**
     * Unused for now
     */
    public static function generateRuleId()
    {
        $array = Rule::scanDirectory(DATA_ROOT . 'code');
        $id = empty($array) ? 0 : max($array);

        return ++$id;
    }

    /**
     * Scan the directory and put all the rules id in an array
     *
     * @param  String $dir The directory to be scanned.
     * @return array  $all_ids The array which contains all the rules id.
     */
    public static function scanDirectory($dir)
    {
        if (is_dir($dir)) {
            $me = opendir($dir);
            while ($child = readdir($me)) {
                if ($child != '.' && $child != '..') {
                    $folder = $dir . DIRECTORY_SEPARATOR . $child;
                    if ($child == 'rules.php') {
                        $code = unserialize(file_get_contents($folder));
                        foreach (array_keys($code['rules']) as $key => $value) {
                            self::$all_ids[] = $value;
                        }
                    }
                    Rule::scanDirectory($folder);
                }
            }
            unset($code);
        }

        return self::$all_ids;
    }

    /**
     * Check if the type of the rule is supported or not
     *
     * @param  String  $type The type of the rule we want to check.
     * @return boolean True if the type is supported.
     */
    public static function isSupportedType($type)
    {
        return array_key_exists($type, self::$rules_type);
    }

    /**
     * Get the list of all the types of rules
     *
     * @return array rules_type which contains all the supported types.
     */
    public static function getRulesTypeList()
    {
        return self::$rules_type;
    }
}

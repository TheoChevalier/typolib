<?php
namespace Typolib;

$edit_mode = true;

$type = $_GET['type'];
$comment = $_GET['comment'];
$type_number = $_GET['type_number'];
$rule_number = $_GET['rule_number'];
$content_array = json_decode($_GET['array']);

$array_OK = true;
$adding_rule = true;
$ignore_variable_OK = true;
if (! empty($content_array)) {
    foreach ($content_array as $key => $value) {
        if (empty($value)) {
            $array_OK = false;
        }
    }
    try {
        if ($array_OK) {
            $rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
            if ($rules != false && array_key_exists('rules', $rules)) {
                foreach ($rules['rules'] as $id => $rule) {
                    if ($rule['type'] == 'quotation_mark') {
                        $adding_rule = false;
                    }
                }
            }
            if ($type == 'ignore_variable') {
                $variable_array = \Typolib\Strings::getArrayFromString($content_array[0]);
                if (in_array('★', $variable_array)) {
                    $position = array_search('★', $variable_array);
                    if ($position == 0 || $position == (sizeof($variable_array) - 1)) {
                        $ignore_variable_OK = false;
                    }
                }
            }
            if ($adding_rule || $type != 'quotation_mark') {
                if ($ignore_variable_OK) {
                    $content_without_tags = [];
                    foreach ($content_array as $key => $field) {
                        $content_without_tags[$key] = Strings::replaceTagsBySpaces($field);
                    }
                    $new_rule = new Rule($code, $locale, $content_without_tags, $type, $comment);
                    $id_rule = $new_rule->getId();
                    $rule = [];
                    $rule['type'] = $type;
                    $rule['content'] = $content_without_tags;
                    $rule['comment'] = $comment;
                    include VIEWS . 'view_rule.php';

                    Utils::closeConnection();

                    $new_rule->saveRule();
                } else {
                    echo '1';
                }
            } else {
                echo '-1';
            }
        } else {
            echo '0';
        }
    } catch (Exception $e) {
    }
} else {
    echo '0';
}

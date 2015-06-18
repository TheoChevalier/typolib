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
            if ($adding_rule || $type != 'quotation_mark') {
                $new_rule = new Rule($code, $locale, $content_array, $type, $comment);
                $id_rule = $new_rule->getId();
                $rule = [];
                $rule['type'] = $type;
                $rule['content'] = $content_array;
                $rule['comment'] = $comment;
                include VIEWS . 'view_rule.php';

                Utils::closeConnection();

                $new_rule->saveRule();
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

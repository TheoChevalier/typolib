<?php
namespace Typolib;

$rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
$rule_exceptions = RuleException::getArrayExceptions($code, $locale, RULES_STAGING);
$ruletypes = Rule::getPrettyRulesTypeList();
if (array_key_exists('rules', $rules)) {
    foreach ($rules['rules'] as $key => $value) {
        $buildRule[$key] = Rule::buildRuleString($value['type'], $value['content']);
    }
} else {
    $buildRule = '';
}

$edit_mode = $_GET['mode'] == '1';
include VIEWS . 'view_treeview.php';

<?php
namespace Typolib;

$repo = $page == 'display' ? RULES_PRODUCTION : RULES_STAGING;

$rules = Rule::getArrayRules($code, $locale, $repo);
$rule_exceptions = RuleException::getArrayExceptions($code, $locale, $repo);
$ruletypes = Rule::getPrettyRulesTypeList();
if ($rules != false && array_key_exists('rules', $rules)) {
    foreach ($rules['rules'] as $key => $value) {
        $buildRule[$key] = Rule::buildRuleString($value['type'], $value['content']);
    }
} else {
    $buildRule = '';
}

$edit_mode = $_GET['mode'] == '1';
include VIEWS . 'view_treeview.php';

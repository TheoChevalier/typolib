<?php
namespace Typolib;

$rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
$ruletypes = Rule::getRulesTypeList();
$rule_exceptions = RuleException::getArrayExceptions($code, $locale, RULES_STAGING);
foreach (Rule::getRulesTypeList() as $key => $value) {
    $ruletypes[$key] = sprintf(str_replace('%s', '%1$s', $value), '[…]');
}
if (array_key_exists('rules', $rules)) {
    foreach ($rules['rules'] as $key => $value) {
        $buildRule[$key] = Rule::buildRuleString($value['type'], $value['content']);
    }
} else {
    $buildRule = '';
}

include VIEWS . 'view_treeview.php';

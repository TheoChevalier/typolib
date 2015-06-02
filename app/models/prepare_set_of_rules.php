<?php
namespace Typolib;

$rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
$ruletypes = Rule::getPrettyRulesTypeList();
$rule_exceptions = RuleException::getArrayExceptions(
                                                        $code,
                                                        $locale,
                                                        RULES_STAGING
                                                    );
foreach ($rules['rules'] as $key => $value) {
    $buildRule[$key] = Rule::buildRuleString($value['type'], $value['content']);
}

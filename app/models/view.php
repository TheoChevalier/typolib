<?php
namespace Typolib;

use Transvision\Utils;

$locale_selector = Utils::getHtmlSelectOptions(
                                Locale::getLocaleList(),
                                $locale
                            );

$rules = Rule::getRulesTypeList();
reset($rules);
$ruletypes = Rule::getPrettyRulesTypeList();
$ruletypes_selector = Utils::getHtmlSelectOptions(
                                $ruletypes,
                                key($rules),
                                true
                            );

$repo = $page == 'display' ? RULES_PRODUCTION : RULES_STAGING;

$codes = $code_key = Code::getCodeList($locale, $repo);
reset($code_key);
$code_key = key($code_key);
$code_selector = Utils::getHtmlSelectOptions($codes, $code_key, true);

$first_rule = array_values($rules)[0];
$rules = Rule::getArrayRules($code_key, $locale, $repo);

$rule_exceptions = RuleException::getArrayExceptions($code_key, $locale, $repo);

if (array_key_exists('rules', $rules)) {
    foreach ($rules['rules'] as $key => $value) {
        $buildRule[$key] = Rule::buildRuleString($value['type'], $value['content']);
    }
}

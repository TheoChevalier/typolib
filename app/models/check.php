<?php
namespace Typolib;

use Transvision\Utils;

$locale_selector = Utils::getHtmlSelectOptions(
                                Locale::getLocaleList(),
                                $locale
                            );

$rules = Rule::getRulesTypeList();
reset($rules);

$codes = $code_key = Code::getCodeList($locale, RULES_STAGING);
reset($code_key);
$code_key = key($code_key);
$code_selector = Utils::getHtmlSelectOptions($codes, $code_key, true);

$first_rule = array_values($rules)[0];
$rules = Rule::getArrayRules($code_key, $locale, RULES_STAGING);

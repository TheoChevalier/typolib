<?php
namespace Typolib;

use Transvision\Utils;

/* Model we call to populate the Edit Code form. */

$locale = $_GET['locale'];
$old_code = $_GET['code'];
$rules = Rule::getArrayRules($old_code, $locale, RULES_STAGING);
$common = $rules['common'];
$name = $rules['name'];
unset($rules);

$codes = $code_key = Code::getCodeList($locale, RULES_STAGING);
reset($code_key);
$code_key = key($code_key);
$code_selector = Utils::getHtmlSelectOptions($codes, $code_key, true);

$page_title = "Options for “{$name}”";

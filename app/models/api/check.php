<?php
namespace Typolib;

$user_string = $_GET['string'];
if (!empty($user_string)) {
    $rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
    $exceptions = RuleException::getArrayExceptions($code, $locale, RULES_STAGING);

    if (! empty($rules)) {
        $result = Rule::process($user_string, $rules, $exceptions, $locale);
        echo $result[0];
    } else {
        echo '0';
    }
} else {
    echo '0';
}

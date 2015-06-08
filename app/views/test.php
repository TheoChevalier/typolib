<?php
namespace Typolib;

/* Test something here */
$locales = Locale::getLocaleList();
dump($locales);

$rules = Rule::getArrayRules('test_check', 'fr', RULES_STAGING);
$exceptions = RuleException::getArrayExceptions('test_check', 'fr', RULES_STAGING);

$result = Rule::process('" coucou " ', $rules, $exceptions);
dump($result);
?>

<form id="mainform">
    <p>Result: <?=$locales[0]?></p>
</form>

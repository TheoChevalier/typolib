<?php
namespace Typolib;

/* Test something here */
$locales = Locale::getLocaleList();
dump($locales);

$rules = Rule::getArrayRules('test_check', 'fr', RULES_STAGING);
$exceptions = RuleException::getArrayExceptions('test_check', 'fr', RULES_STAGING);
//$array = File::getFileContent('/home/al2c/Téléchargements/mozilla_en-US_fr.tmx', 'fr', 'tmx');
if (! empty($rules)) {
    $result = Rule::process("Voulez-vous vraiment la supprimer ?", $rules, $exceptions, $locale);
    dump($result);
}
?>

<form id="mainform">
    <p>Result: <?=$locales[0]?></p>
</form>

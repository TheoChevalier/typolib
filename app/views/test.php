<?php
namespace Typolib;

/* Test something here */
$locales = Locale::getLocaleList();
dump($locales);

$rules = Rule::getArrayRules('test_check', 'fr', RULES_STAGING);
$exceptions = RuleException::getArrayExceptions('test_check', 'fr', RULES_STAGING);
$array = File::getFileContent('/home/al2c/Téléchargements/mozilla_en-US_fr(2).tmx', 'fr', 'tmx');
if (! empty($rules)) {
    $result = Rule::processArray($array, $rules, $exceptions, 'fr');
    file_put_contents("/home/al2c/Téléchargements/test.php", sizeof($array) . sizeof($result) . print_r($result, true));
}

/*$result = Rule::process(';Espace;disque requis : ', $rules, $exceptions, 'fr');
dump($result);*/
?>

<form id="mainform">
    <p>Result: <?=$locales[0]?></p>
</form>

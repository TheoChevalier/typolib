<?php
namespace Typolib;

$code = $_POST['code'];
$locale = $_POST['locale'];

$uploaddir = CACHE_PATH;
$uploadfile = $uploaddir . basename($_FILES['user_file']['name']);

if (move_uploaded_file($_FILES['user_file']['tmp_name'], $uploadfile)) {
    $rules = Rule::getArrayRules($code, $locale, RULES_STAGING);
    $exceptions = RuleException::getArrayExceptions($code, $locale, RULES_STAGING);
    $array = File::getFileContent($uploadfile, $locale, 'tmx');
    if (! empty($rules)) {
        $result = Rule::processArray($array, $rules, $exceptions, $locale);
        file_put_contents(CACHE_PATH . "test.php", sizeof($array) . ' ' . sizeof($result) . ' ' . print_r($result, true));
    }
} else {
    $error_msg[] = "We’re sorry, an error occurred when uploading the file.";
    print_r($_FILES['user_file']);
}

<?php
namespace Typolib;

$code = $_POST['code'];
$locale = $_POST['locale'];

$uploaddir = CACHE_PATH;
$uploadfile = $uploaddir . basename($_FILES['user_file']['name']);
$ext = pathinfo($uploadfile, PATHINFO_EXTENSION);

if (File::isSupportedType($ext)) {
    if (move_uploaded_file($_FILES['user_file']['tmp_name'], $uploadfile)) {
        $rules = Rule::getArrayRules($code, $locale, RULES_PRODUCTION);
        $exceptions = RuleException::getArrayExceptions($code, $locale, RULES_PRODUCTION);
        $array = File::getFileContent($uploadfile, $locale, $ext);
        if (! empty($rules)) {
            $result = Rule::processArray($array, $rules, $exceptions, $locale);
        }
    } else {
        $error_msg[] = 'We’re sorry, an error occurred when uploading the file.';
    }
} else {
    $error_msg[] = 'We’re sorry, the type of the file is not supported by ' . PRODUCT . '.';
}

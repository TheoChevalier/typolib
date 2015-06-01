<?php
namespace Typolib;

use Transvision\Utils;

$locale = $_GET['locale'];
$code_name = $_GET['name'];
$use_common_code = isset($_GET['common']);

$locale_selector = Utils::getHtmlSelectOptions(
                                Locale::getLocaleList(),
                                $locale
                            );

if ($code_name != '') {
    try {
        $code = new Code($code_name, $locale, $use_common_code);
        $success_msg[] = 'Code successfully inserted.';
    } catch (Exception $e) {
        $error_msg[] = $e->getMessage();
    }
} else {
    $error_msg[] = 'Code name is empty.';
}

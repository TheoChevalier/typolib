<?php
namespace Typolib;

use Transvision\Utils;

$repo = $_GET['mode'] == 0 ? RULES_PRODUCTION : RULES_STAGING;

$codes = $code_key = Code::getCodeList($locale, RULES_STAGING);
reset($code_key);
echo Utils::getHtmlSelectOptions($codes, key($code_key), true);

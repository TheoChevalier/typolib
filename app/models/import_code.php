<?php
namespace Typolib;

Code::importCode($_GET['old_code'], $_GET['locale'], $_GET['code'], RULES_STAGING);
$success_msg[] = 'Code successfully imported.';

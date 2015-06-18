<?php
namespace Typolib;

/* Model we call to process the data sent using Edit Code form. */

$common = isset($_GET['common']);
Code::editCode($_GET['old_code'], $_GET['name'], $_GET['locale'], $common);
$success_msg[] = 'Set of rules successfully updated. You can check your changes from <a href="/display-unverified">Unverified rules viewer</a>. We will review your changes shortly.';

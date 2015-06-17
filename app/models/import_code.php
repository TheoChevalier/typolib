<?php
namespace Typolib;

Code::importCode($_GET['old_code'], $_GET['locale'], $_GET['code'], '', RULES_STAGING);
$success_msg[] = 'Code successfully imported. You can check your changes from <a href="/display-unverified">Unverified rules viewer</a>. We will review your changes shortly.';

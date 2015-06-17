<?php
namespace Typolib;

/* Model we call to delete a Code */

Code::deleteCode($_GET['old_code'], $_GET['locale']);
$success_msg[] = 'Set of rules successfully deleted. You can check your changes from <a href="/display-unverified">Unverified rules viewer</a>. We will review your changes shortly.';

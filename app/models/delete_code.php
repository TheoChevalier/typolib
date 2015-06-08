<?php
namespace Typolib;

/* Model we call to delete a Code */

Code::deleteCode($_GET['old_code'], $_GET['locale']);
$success_msg[] = 'Code successfully deleted';

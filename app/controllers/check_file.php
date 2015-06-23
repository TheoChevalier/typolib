<?php

if (isset($_FILES['user_file'])) {
    include MODELS . 'check_file_sent.php';
    include VIEWS . 'check_file_sent.php';
} else {
    $javascript_include = ['ajax_check_file.js'];
    include MODELS . 'check.php';
    include VIEWS . 'check_file.php';
}

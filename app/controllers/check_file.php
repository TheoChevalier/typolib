<?php

if (isset($_FILES['user_file'])) {
    include MODELS . 'check_file_sent.php';
    include VIEWS . 'check_file_sent.php';
} else {
    include MODELS . 'check.php';
    include VIEWS . 'check_file.php';
}

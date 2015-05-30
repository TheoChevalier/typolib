<?php

if (isset($_GET['edit_code'])) {
    include MODELS . 'edit_code.php';
    include VIEWS . 'edit_code.php';
} elseif (isset($_GET['edit_code_sent'])) {
    include MODELS . 'edit_code_sent.php';
    include MODELS . 'view.php';
    include VIEWS . 'manage.php';
} elseif (isset($_GET['delete_code'])) {
    include MODELS . 'delete_code.php';
    include MODELS . 'view.php';
    include VIEWS . 'manage.php';
} else {
    include MODELS . 'view.php';
    include VIEWS . 'manage.php';
}

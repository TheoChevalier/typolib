<?php

$js = ['ajax_insert.js', 'modal.js'];
$css = ['treeview.css', 'buttons.css', 'modal.css'];

if (isset($_GET['edit_code'])) {
    include MODELS . 'edit_code.php';
    include VIEWS . 'edit_code.php';
} elseif (isset($_GET['edit_code_sent'])) {
    $javascript_include = $js;
    $css_include = $css;
    include MODELS . 'edit_code_sent.php';
    include MODELS . 'view.php';
    include VIEWS . 'view.php';
} elseif (isset($_GET['delete_code'])) {
    $javascript_include = $js;
    $css_include = $css;
    include MODELS . 'delete_code.php';
    include MODELS . 'view.php';
    include VIEWS . 'view.php';
} else {
    $javascript_include = $js;
    $css_include = $css;
    include MODELS . 'view.php';
    include VIEWS . 'view.php';
}

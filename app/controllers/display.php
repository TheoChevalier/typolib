<?php

$javascript_include = ['ajax_display.js'];
$css_include = ['treeview.css'];
$edit_mode = false;
$repo = $page == 'display-verified' ? RULES_PRODUCTION : RULES_STAGING;

include MODELS . 'view.php';
include VIEWS . 'display.php';

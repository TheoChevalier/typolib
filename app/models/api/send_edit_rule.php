<?php
namespace Typolib;

$edit_mode = true;

$id_rule = $_GET['id_rule'];
$comment = $_GET['comment'];
$content_array = array_filter(json_decode($_GET['array']));

$array_OK = true;
if (! empty($content_array)) {
    foreach ($content_array as $key => $value) {
        if ($value == '') {
            $array_OK = false;
        }
    }
    if ($array_OK) {
        Rule::manageRule($code, $locale, $id_rule, 'update_content', $content_array, $comment);

        include MODELS . 'prepare_set_of_rules.php';
        include VIEWS . 'view_treeview.php';
    } else {
        echo '0';
    }
} else {
    echo '0';
}

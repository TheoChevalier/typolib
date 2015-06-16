<?php
namespace Typolib;

$edit_mode = true;

$id_rule = $_GET['id_rule'];
$comment = $_GET['comment'];
$id_type = $_GET['id_type'];

$content_array = array_filter(json_decode($_GET['array']));

$array_OK = true;
if (! empty($content_array)) {
    foreach ($content_array as $key => $value) {
        if ($value == '') {
            $array_OK = false;
        }
    }
    if ($array_OK) {
        $new_rule = Rule::buildRuleString($id_type, $content_array);

        Utils::closeConnection($new_rule);

        Rule::manageRule($code, $locale, $id_rule, 'update_content', $content_array, $comment);
    } else {
        echo '0';
    }
} else {
    echo '0';
}

<?php
namespace Typolib;

$edit = true;

$locale = $_GET['locale'];
$code_name = $_GET['code'];
$id_rule = $_GET['id_rule'];
$rules = Rule::getArrayRules($code_name, $locale, RULES_STAGING);

$rule = $rules['rules'][$id_rule];
$id_type = $rule['type'];
$rule_content = $rule['content'];

$rule_comment = isset($rule['comment']) ? $rule['comment'] : '';

include VIEWS . 'rule_form_template.php';

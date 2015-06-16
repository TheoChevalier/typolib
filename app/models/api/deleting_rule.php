<?php
namespace Typolib;

$id_rule = $_GET['id_rule'];

Utils::closeConnection('1');

Rule::manageRule($code, $locale, $id_rule, 'delete');

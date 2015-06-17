<?php
namespace Typolib;

$id_rule = $_GET['id_rule'];

echo '1';
Utils::closeConnection();

Rule::manageRule($code, $locale, $id_rule, 'delete');

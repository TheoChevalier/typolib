<?php
namespace Typolib;

$id_exception = $_GET['id_exception'];
$id_rule = $_GET['id_rule'];

echo '1';
Utils::closeConnection();

RuleException::manageException($code, $locale, $id_rule, 'delete', $id_exception);

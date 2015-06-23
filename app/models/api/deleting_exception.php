<?php
namespace Typolib;

$id_exception = $_GET['id_exception'];

echo '1';
Utils::closeConnection();

RuleException::manageException($code, $locale, $id_exception, 'delete');

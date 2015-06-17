<?php
namespace Typolib;

$exception = $_GET['exception'];
$id_exception = $_GET['id_exception'];

if (! empty($exception)) {

    echo '1';
    // Closing connection now, so that commit is done in the background and user doesn't wait
    Utils::closeConnection();

    RuleException::manageException($code, $locale, $id_exception, 'update_content', $exception);
} else {
    echo '0';
}

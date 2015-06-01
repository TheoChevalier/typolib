<?php
namespace Typolib;

if (isset($_GET['locale'])) {
    include MODELS . 'inserted.php';
    include VIEWS . 'insert.php';
} else {
    include MODELS . 'insert.php';
    include VIEWS . 'insert.php';
}

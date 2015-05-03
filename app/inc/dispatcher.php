<?php
namespace Transvision;

$template     = false;
$page         = $urls[$url['path']];
$extra        = null;
$show_title   = true;

switch ($url['path']) {
    case '/':
        $controller = 'insert';
        $page_title = 'Adding new rules';
        $page_descr = '';
        break;
    case 'insert':
        $controller = 'insert';
        $page_title = 'Adding new rules';
        $page_descr = '';
        break;
    default:
        $controller = 'insert';
        $page_title = 'Adding new rules';
        $page_descr = '';
        break;
}

if ($template) {
    ob_start();

    if (isset($view)) {
        include VIEWS . $view . '.php';
    } else {
        include CONTROLLERS . $controller . '.php';
    }

    $content = ob_get_contents();
    ob_end_clean();

    // display the page
    require_once VIEWS . 'templates/base.php';
} else {
    if (isset($view)) {
        include VIEWS . $view . '.php';
    } else {
        include CONTROLLERS . $controller . '.php';
    }
}

// Log script performance in PHP integrated developement server console
Utils::logScriptPerformances();

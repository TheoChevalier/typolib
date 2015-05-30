<?php
namespace Typolib;

use Transvision\Utils;

// Init locale with browser locale if we support it; first locale we support, otherwise.
$l10n = new \tinyl10n\ChooseLocale(Locale::getLocaleList());
$locale = $l10n->getCompatibleLocale();

$success = $errors = [];

$template     = true;
$page         = $urls[$url['path']];
$extra        = null;
$show_title   = true;

switch ($url['path']) {
    case '/':
        $controller = 'check';
        $page_title = 'Check text';
        $page_descr = 'Enter text, select a set of rules to apply and you’re good to go!';
        break;
    case 'api':
        $template = false;
        $controller = 'api';
        $show_title = false;
        break;
    case 'check':
        $controller = 'check';
        $page_title = 'Check text';
        $page_descr = 'Enter text, select a set of rules to apply and you’re good to go!';
        break;
    case 'display':
        $controller = 'display';
        $page_title = 'Display rules';
        $page_descr = 'Display any rule used by Typolib’ and all its comments and exceptions.';
        break;
    case 'edit':
        $controller = 'view';
        $page_title = 'Rules editor';
        $page_descr = '';
        break;
    case 'insert':
        $controller = 'insert';
        $page_title = 'Create a code';
        $page_descr = '';
        break;
    case 'manage':
        $controller = 'manage';
        $page_title = 'Rules manager';
        $page_descr = 'Create new set of rules, edit or delete existing rules.';
        break;
    case 'test':
        $view       = 'test';
        $page_title = 'Test page';
        $page_descr = 'This is a page for test purposes only.';
        break;
    default:
        $controller = 'check';
        $page_title = 'Check text';
        $page_descr = 'Enter text, select a set of rules to apply and you’re good to go!';
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

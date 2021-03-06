<?php
namespace Typolib;

use Transvision\Utils;

// Init locale with browser locale if we support it; first locale we support, otherwise.
$l10n = new \tinyl10n\ChooseLocale(Locale::getLocaleList());
$locale = $l10n->getCompatibleLocale();

$repo_mgr = new RepoManager();
$repo_mgr->cloneAndConfig();
$repo_args = ['repo' => RULES_PRODUCTION];
$repo_mgr_prod = new RepoManager($repo_args);
$repo_mgr_prod->cloneAndConfig();

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
    case 'about':
        $view = 'about';
        $page_title = 'About ' . PRODUCT;
        $page_descr = '';
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
    case 'check-file':
        $controller = 'check_file';
        $page_title = 'Check a file';
        $page_descr = 'Send us your translation memory file, and we’ll check it for you.';
        break;
    case 'display-verified':
        $controller = 'display';
        $page_title = 'Verified rules viewer';
        $page_descr = 'Display any verified rule used by Typolib’ and all its comments and exceptions.';
        break;
    case 'display-unverified':
        $controller = 'display';
        $page_title = 'Unverified rules viewer';
        $page_descr = 'Display any unverified rule used by Typolib’ and all its comments and exceptions.';
        break;
    case 'edit':
        $controller = 'view';
        $page_title = 'Unverified rules editor';
        $page_descr = '';
        break;
    case 'insert':
        $controller = 'insert';
        $page_title = 'New set of rules';
        $page_descr = '';
        break;
    case 'test':
        $view       = 'test';
        $page_title = 'Test page';
        $page_descr = 'This is a page for test purposes only.';
        break;
    case 'user-guide':
        $view = 'user-guide';
        $page_title = 'User guide ' . PRODUCT;
        $page_descr = '';
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

// Log script performance in PHP integrated development server console
Utils::logScriptPerformances();

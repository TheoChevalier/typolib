<?php
namespace Typolib;

use Transvision\Utils;

$repo_mgr = new RepoManager();
$repo_mgr->checkForUpdates();

$locale_selector = Utils::getHtmlSelectOptions(
                                Locale::getLocaleList(),
                                $locale
                            );

$rules = Rule::getRulesTypeList();
reset($rules);
$ruletypes = Rule::getPrettyRulesTypeList();
$ruletypes_selector = Utils::getHtmlSelectOptions(
                                $ruletypes,
                                key($rules),
                                true
                            );

$codes = $code_key = Code::getCodeList($locale, $repo);
reset($code_key);
$code_key = key($code_key);
$code_selector = Utils::getHtmlSelectOptions($codes, $code_key, true);

$first_rule = array_values($rules)[0];
$rules = Rule::getArrayRules($code_key, $locale, $repo);

$rule_exceptions = RuleException::getArrayExceptions($code_key, $locale, $repo);

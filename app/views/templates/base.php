<?php

ob_start();

$javascript_include = isset($javascript_include) ? $javascript_include : [];
$css_include = isset($css_include) ? $css_include : [];
$success_msg = isset($success_msg) ? $success_msg : [];
$error_msg = isset($error_msg) ? $error_msg : [];

$title_productname = PRODUCT;

if (strpos(VERSION, 'dev') !== false) {
    $beta_version = true;
} else {
    $beta_version = false;
}

?>
<!doctype html>

<html lang="en" dir="ltr">
  <head>
    <title><?php if ($show_title == true) {
    echo $page_title . ' — ';
} ?><?=$title_productname?></title>
    <meta charset="utf-8" />
    <meta name="title" content="<?=$title_productname?>" />
    <meta name="description" content="<?=$title_productname?> is a tool helping software localizers doing localization QA for typography. It helps keeping typography consistent and you can adapt the rules to the context of your software and your locale." />
    <meta name="keywords" content="localization, typography, quality assurance, punctuation, translation, consistency" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/buttons.css?<?= VERSION ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="/style/menu.css?<?= VERSION ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="/style/typolib.css?<?= VERSION ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="/assets/font-awesome/font-awesome-built.css?<?= VERSION ?>" type="text/css" media="all" />

    <?php
    foreach ($css_include as $css_file) {
        echo "<link rel=\"stylesheet\" href=\"/style/{$css_file}?" . VERSION . "\" type=\"text/css\" media=\"all\" />\n";
    }
    ?>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v2" />
  </head>
<body id="<?=$page?>">
  <header>
    <?php
    if ($beta_version) {
        echo "<div id='beta-badge'><span>BETA</span></div>\n";
    }
    ?>
    <h1 id="logo"><a href="/" id="typolib-title"><?= PRODUCT ?></a></h1>
  </header>

  <div id='cssmenu'>
    <ul>
       <li <?=$page == 'root' ? 'class="active"' : ''?>><a href='/'>Home</a></li>
       <li class='<?=$page == 'edit' || $page == 'display-verified' || $page == 'display-unverified' || $page == 'insert' ? 'active ' : ''?>has-sub'><a href='/display-verified'>Rules</a>
          <ul>
               <li><a href='/display-verified'>Verified rules viewer</a></li>
               <li><a href='/display-unverified'>Unverified rules viewer</a></li>
               <li><a href='/edit'>Unverified rules editor</a></li>
               <li><a href='/insert'>New set of rules</a></li>
          </ul>
       </li>
       <li class='<?=$page == 'check' || $page == 'check-file' ? 'active ' : ''?>has-sub'><a href='/check'>Check</a>
          <ul>
               <li <?=$page == 'check' ? 'class="active"' : ''?>><a href='/check'>Check text</a></li>
               <li <?=$page == 'check-file' ? 'class="active"' : ''?>><a href='/check-file'>Check file</a></li>
          </ul>
       </li>
       <li <?=$page == 'user-guide' ? 'class="active"' : ''?>><a href='/user-guide'>User guide</a></li>
       <li <?=$page == 'about' ? 'class="active"' : ''?>><a href='/about'>About</a></li>
    </ul>
  </div>

  <div id="content-wrap">

    <?php if ($show_title == true): ?>
    <h2 id="page-title"><?=$page_title?></h2>
    <h3 id="page-descrition"><?=$page_descr?></h3>
    <?php endif; ?>

    <?php if (array_filter($success_msg)): ?>
    <div id="success">
        <button class="close-alert">×</button>
        <ul>
        <?php foreach ($success_msg as $s) : ?>
            <li><?=$s?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (array_filter($error_msg)): ?>
    <div id="errors">
        <button class="close-alert">×</button>
        <ul>
        <?php foreach ($error_msg as $error) : ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div id="page-content">
      <?=$extra?>
      <?=$content?>
    </div>

    <div id="noscript-warning">
      Please enable JavaScript. Some features won’t be available without it.
    </div>

  </div>

  <footer>
    <p><?= PRODUCT ?> v<?= VERSION ?> — MPL 2 — 2014 - <?= date("Y"); ?></p>
  </footer>

  <script src="/assets/jquery/jquery.min.js"></script>
  <script src="/assets/jquery-ui/jquery-ui.min.js"></script>
  <script src="/js/base.js?<?= VERSION ?>"></script>
  <?php
    foreach ($javascript_include as $js_file) {
        echo "    <script src=\"/js/{$js_file}?" . VERSION . "\"></script>\n";
    }
  ?>
</body>
</html>

<?php

$content = ob_get_contents();

ob_end_clean();

print $content;

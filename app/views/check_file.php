<?php
namespace Typolib;

$formats = '';
$i = 0;

foreach (File::getSupportedTypes() as $format) {
    if ($format != 'array') {
        if ($i > 0) {
            $formats .= ', .' . $format;
        } else {
            $formats .= '.' . $format;
        }
        $i++;
    }
}
?>

<form enctype="multipart/form-data" action="/check-file/" id="mainform" method="post">
    <h2>Select a set of rules</h2>
    <fieldset>
        <label>Locale</label>
        <div class="select-style">
            <select name="locale" title="Locale" id="locale_selector">
            <?=$locale_selector?>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <label>Set of rules</label>
        <div class="select-style">
            <select name="code" title="Set of rules" id="code_selector">
            <?=$code_selector?>
            </select>
        </div>
    </fieldset>
    <h2>Select a file</h2>
    <fieldset>
    <input name="MAX_FILE_SIZE" type="hidden" value="8000000">
    <input name="user_file" type="file" accept="<?=$formats?>" />
    <br/><br/>8MB max — Accepted files: <?=$formats?>.
    </fieldset>
    <br/>
    <br/>
    <span id="spinner-file" style="display:none;">
        <i class="fa fa-spinner fa-spin fa-2x"></i> We’re parsing your file, this could take a while…
    </span>
    <input type="submit" class="button" value="Send" onClick="$(this).hide();$('spinner-file').show();" />
</form>

<form name="addform" id="mainform" method="get" action="">
<div id="result"></div>
    <fieldset id="main">
        <fieldset>
            <p>
                New name of this set of rules<br />
                <input type="text" name="name" value="<?=isset($name) ? $name : '' ?>"/>
            </p>
        </fieldset>
        <br/>
        <fieldset>
            <input type="checkbox" name="common" id="common" <?=isset($common) && $common ? 'checked' : '' ?>/>
            <label for="common">Use the common rules of this locale (<?=$locale?>)</label>
        </fieldset>
        <br/>
        <input type="hidden" name="old_code" value="<?=isset($old_code) ? $old_code : '' ?>" />
        <input type="hidden" name="locale" value="<?=isset($locale) ? $locale : '' ?>" />
        <input type="submit" class="button" name="edit_code_sent" value="Edit" alt="Edit" />
    </fieldset>
    <br/>
    <?php if (isset($code_selector)) : ?>
        <h2>Import an existing code</h2>
        <fieldset>
            <label>Code</label>
            <div class="select-style">
                <select name="code" title="Code" id="code_selector">
                <?=$code_selector?>
                </select>
            </div>
        </fieldset>
        <br/>
        <br/>
        <input type="submit" class="button" name="import_code" value="Import" alt="Import" />
    <?php endif; ?>
    <br/>
    <h2>Advanced options</h2>
    <p>
        If this set of rules is now useless (e.g. because it has been created by mistake or is a duplicate of another one), you can delete it below.
        <br/>Please note that <span class="bold">this action cannot be undone.</span>
    </p>
    <fieldset id="delete_code">
    <button type="submit" name="delete_code" class="button button-red" title="Delete current set of rules">
        <i class="fa fa-times fa-15x"></i> Delete
    </button>
</fieldset>
</form>

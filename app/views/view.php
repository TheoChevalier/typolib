<form name="addform" id="mainform" method="get" action="">

    <fieldset id="main">
        <?php if (isset($locale_selector)) : ?>
        <fieldset>
            <label>Locale</label>
            <div class="select-style">
                <select name="locale" title="Locale" id="locale_selector">
                <?=$locale_selector?>
                </select>
            </div>
        </fieldset>
        <?php endif; ?>

        <?php if (isset($code_selector)) : ?>
        <fieldset>
            <label>Code</label>
            <div class="select-style">
                <select name="code" title="Code" id="code_selector">
                <?=$code_selector?>
                </select>
            </div>
        </fieldset>
        <?php endif; ?>

        <?php if (isset($ruletypes_selector)) : ?>
        <fieldset>
            <label>Rule type</label>
            <div class="select-style">
                <select name="type" title="Rule type" id="addrule_type">
                <?=$ruletypes_selector?>
                </select>
            </div>
        </fieldset>
        <?php endif; ?>

        <a href="/insert" class="button button-green" role="button" title="Add a new code"><i class="fa fa-plus fa-15x"></i></a>
        <button type="submit" name="edit_code" class="button" title="Edit current code"><i class="fa fa-edit fa-15x"></i></button>
        <button type="submit" name="delete_code" class="button button-negative" title="Delete current code"><i class="fa fa-times fa-15x"></i></button>

        <div id="template">

        </div>

        <p>Enter a comment:<br />
        <input type="text" name="comment" id="comment" class="big-input"/></p>

        <br/>
        <input type="submit" id="submitRule" class="button-flat" value="Add" />
    </fieldset>
    <div id="results"><?php include VIEWS . 'view_treeview.php'; ?></div>
</form>
<?php

include VIEWS . 'modal.php';

foreach ($ruletypes as $id_type => $pretty_name) {
    include VIEWS . 'rule_form_template.php';
}

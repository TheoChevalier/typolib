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

        <fieldset id="edit_code">
            <button type="submit" name="edit_code" class="button" title="Edit current code">
                <i class="fa fa-edit fa-15x"></i> Edit code name and options
            </button>
        </fieldset>
        <fieldset id="delete_code">
            <button type="submit" name="delete_code" class="button button-negative" title="Delete current code">
                <i class="fa fa-times fa-15x"></i> Delete this code
            </button>
        </fieldset>
        <br/>
        <?php if (isset($ruletypes_selector)) : ?>
        <fieldset id="rule_type">
            <label>Rule type</label>
            <div class="select-style">
                <select name="type" title="Rule type" id="addrule_type">
                <?=$ruletypes_selector?>
                </select>
            </div>
        </fieldset>
        <?php endif; ?>

        <div id="template"></div>

        <br/>

        <fieldset id="add_comment">
            Enter a comment:<br />
            <input type="text" name="comment" id="comment" class="big-input"/><br/>

            <br/>
            <input type="submit" id="submitRule" class="button-flat" value="Add" />
        </fieldset>
    </fieldset>
    <div id="results"><?php include VIEWS . 'view_treeview.php'; ?></div>
</form>
<?php

include VIEWS . 'modal.php';

$edit = false;
foreach ($ruletypes as $id_type => $pretty_name) {
    include VIEWS . 'rule_form_template.php';
}

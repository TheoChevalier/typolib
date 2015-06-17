<form name="addform" id="mainform" method="get" action="">

    <fieldset id="main">
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

        <fieldset>
            <fieldset id="edit_code">
                <button type="submit" name="edit_code" class="button" title="Edit current code">
                    <i class="fa fa-cog fa-15x"></i> Options
                </button>
            </fieldset>
        </fieldset>
    </fieldset>

    <div id="results">
        <?php include VIEWS . 'view_treeview.php'; ?>
    </div>

    <div id="new_rule">
        <h2>Adding a new rule</h2>

        <fieldset id="rule_type">
            <label>Rule type</label>
            <div class="select-style">
                <select name="type" title="Rule type" id="addrule_type">
                <?=$ruletypes_selector?>
                </select>
            </div>
        </fieldset>

        <div id="template"></div>
    </div>

<div class="notice">
    <h4>Notice: Changes availability</h4>
    <p>Please note that your changes will be visible immediately in edit mode, but we need to check them first before anyone can use them. We try to do that quickly, but in the mean time, you can do as many changes as you wish.</p>
</div>

</form>

<?php

include VIEWS . 'modal.php';

$edit = false;
foreach ($ruletypes as $id_type => $pretty_name) {
    include VIEWS . 'rule_form_template.php';
}

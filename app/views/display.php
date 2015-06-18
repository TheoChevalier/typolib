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
    </fieldset>
    <div id="results"><?php include VIEWS . 'view_treeview.php'; ?></div>
</form>

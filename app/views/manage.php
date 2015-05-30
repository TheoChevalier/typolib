<form name="addform" id="mainform" method="get" action="">
    <h2>You can edit an existing code</h2>
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
    </fieldset>

    <a href="/edit" class="button" title="Edit current code">
        <i class="fa fa-edit fa-15x"></i> Edit code
    </a>
    <br/>

    <h2>Or create a new one</h2>
    <p>
        <a href="/insert" class="button button-green" role="button" title="Add a new code">
            <i class="fa fa-plus fa-15x"></i> Create a new code
        </a>
    </p>
</form>


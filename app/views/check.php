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
        <br/>
        <fieldset>
            <label for="enterText">Enter your text</label>
            <br/>
            <textarea id="enterText" name="enterText" rows="3" cols="15"></textarea>
        </fieldset>
        <fieldset>
            <label for="potentialErrors">Potential errors</label>
            <br/>
            <textarea id="checkResponse"></textarea>
        </fieldset>
        <br/>
        <input type="submit" class="button-flat" name="check" value="Check" alt="Check" />

        <?php endif; ?>
</form>

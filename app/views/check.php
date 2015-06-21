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
        <br/>
        <fieldset>
            <label for="enterText">Enter your text</label>
            <br/>
            <textarea id="enterText" name="enterText" rows="3" cols="15"></textarea>
        </fieldset>
        <fieldset>
            <label for="checkResponse">Corrected text</label>
            <br/>
            <div id="checkResponse"></div>
            <textarea disabled id="fake-textarea"></textarea>
        </fieldset>
        <br/>
        <input type="submit" class="button" name="check" value="Check" alt="Check" id="submitCheck"/>
    </fieldset>
</form>

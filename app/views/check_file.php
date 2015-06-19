<form enctype="multipart/form-data" action="/check-file/" id="mainform" method="post">
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
    <input name="MAX_FILE_SIZE" type="hidden" value="8000000">
    Send a file: <input name="user_file" type="file" />
    <input type="submit" class="button" value="Send" />
</form>

<form name="addform" id="mainform" method="get" action="">
<div id="result"></div>
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
        <br/>
        <?php endif; ?>

        <fieldset>
            <p>Name of the set of rules<br />
            <input type="text" name="name" /></p>
        </fieldset>
        <br/>
        <fieldset>
            <input type="checkbox" name="common" id="common"/>
            <label for="common">Use the common rules of this locale</label>
        </fieldset>
        <br/>
        <input type="submit" class="button" value="Create" alt="Create" />
    </fieldset>
</form>

<div id="template-<?=$id_type?><?=$edit ? '-edit' : '';?>" class="template-edit" <?=$edit ? '' : 'style="display: none;"'?>>
    <form>
        <?php

        include VIEWS . 'rule_forms/' . $id_type . '.php';

        if ($edit) : ?>
            <fieldset>
                Enter a comment:<br />
                <input type="text" name="comment" id="comment" class="big-input" value="<?=$rule_comment?>"/><br/>
            </fieldset>
            <br/>
            <input type="submit" class="button-flat" value="Edit" />
            <input type="hidden" name="id_rule" value="<?=$id_rule?>" />
        <?php endif; ?>
    </form>
</div>

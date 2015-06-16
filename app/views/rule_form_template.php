<div id="template-<?=$id_type?><?=$edit ? '-edit' : '';?>" class="template-edit" <?=$edit ? '' : 'style="display: none;"'?>>
    <form>
        <?php
            include VIEWS . 'rule_forms/' . $id_type . '.php';
        ?>
            <br/>
            <fieldset>
                Comment, hint or description (optional)<br />
                <textarea name="comment" id="comment<?=$edit ? '-edit' : '';?>" class="big-input"><?=$edit ? $rule_comment : ''?></textarea>
            </fieldset>
            <br/>

        <?php if ($edit) : ?>
            <input type="submit" class="button" value="Edit" />
            <input type="hidden" name="id_rule" value="<?=$id_rule?>" />
            <input type="hidden" name="id_type" value="<?=$id_type?>" />
        <?php else : ?>
            <input type="submit" id="submitRule" class="button" value="Add" />
        <?php endif; ?>
    </form>
</div>

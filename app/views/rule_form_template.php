<div id="template-<?=$id_type?><?=$edit ? '-edit' : '';?>" class="template-edit" style="display: none;">
    <form>
        <?php

        include VIEWS . 'rule_forms/' . $id_type . '.php';

        if ($edit) : ?>
            <br/>
            <input type="submit" class="button-flat" value="Edit" />
        <?php endif; ?>
    </form>
</div>

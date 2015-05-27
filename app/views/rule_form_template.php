<div id="template-<?=$id_type?><?=$edit_mode ? '-edit' : '';?>" style="display: none;">
    <form>
        <?php

        include VIEWS . 'rule_forms/' . $id_type . '.php';

        if ($edit_mode) : ?>
            <input type="submit" value="Edit" />
        <?php endif; ?>
    </form>
</div>

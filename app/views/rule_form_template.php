<div id="template-<?=$id_type?><?=$edit ? '-edit' : '';?>" style="display: none;">
    <form>
        <?php

        include VIEWS . 'rule_forms/' . $id_type . '.php';

        if ($edit) : ?>
            <input type="submit" class="button" value="Edit" />
        <?php endif; ?>
    </form>
</div>

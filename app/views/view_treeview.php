<?php if ($edit_mode) : ?>
<br/><h2>Editing rules and exceptions</h2>
<?php endif; ?>

<div class="treeview">
    <ul>
<?php

    $type_number = 0;
    // Level 1: display all rule types
    foreach ($ruletypes as $id_type => $pretty_name) :
?>
        <li data-id-type="<?=$id_type;?>" data-number-type="<?=$type_number;?>">
            <input type="checkbox" id="item-<?=$type_number;?>" class="switch" />
            <label for="item-<?=$type_number;?>" class="ruletype">
                <?=$pretty_name?>
            </label>
            <ul class="rules">
        <?php
            $rule_number = 0;
            // Level 2: display all rules for each type
            if (isset($rules['rules'])) :
                foreach ($rules['rules'] as $id_rule => $rule) :
                    if (isset($rule['type']) && $rule['type'] == $id_type) :
                        include VIEWS . 'view_rule.php';
                        $rule_number++;
                    endif;
                endforeach; // End level 2
            endif;
        ?>
            </ul>
        </li>
<?php
    $type_number++;
    endforeach; // End level 1
?>
    </ul>
</div>

<div id="exceptionview" style="display: none;">
    <span class="bold">New exception:</span><br />
    <input type="text" id="exception" />
    <input type="button" id="submitRuleException" class="button button-green" value="Add" title="Add a new exception" />
</div>

<span class="edit-exception-form" style="display: none;">
    <input type="text" />
    <input type="button" id="submitUpdatedException" class="button" value="Edit" title="Edit" />
</span>

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
        <li>
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
        ?>
                        <li>
                            <input type="checkbox" id="item-<?=$type_number;?>-<?=$rule_number;?>" class="switch" />
                            <label for="item-<?=$type_number;?>-<?=$rule_number;?>" class="rule" data-id-rule="<?=$id_rule;?>" data-id-type="<?=$id_type;?>">
                                <?=$buildRule[$id_rule]?>
                            </label>
                            <?php if ($edit_mode) :
    ?>
                                <button class="button edit-rule" title="Edit this rule">
                                    <i class="fa fa-edit fa-15x"></i>
                                </button>
                                <button class="button button-red delete-rule close" title="Delete this rule">
                                    <i class="fa fa-times fa-15x"></i>
                                </button>
                            <?php endif; ?>
                            <ul class="exceptions">
                            <?php if (isset($rule['comment'])) : ?>
                                <span class="comment">
                                    <?=$rule['comment']?>
                                </span>
                        <?php
                            endif;
                            $exception_number = 0;
                            // Level 3: display all exceptions for each rule
                            if (isset($rule_exceptions['exceptions'])) {
                                foreach ($rule_exceptions['exceptions'] as $id_exception => $exception) {
                                    if (isset($exception['rule_id']) && $exception['rule_id'] == $id_rule) {
                                        $exception = $exception['content'];
                                        include VIEWS . 'view_exception.php';

                                        $exception_number++;
                                    }
                                } // End level 3
                            }
                            if ($edit_mode) : ?>
                                <a class="new-exception button button-green" href="#"><li>Add new exception</li></a>
                            <?php endif; ?>
                            </ul>
                        </li>
        <?php
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
    <input type="button" id="submitUpdatedException" class="button" value="Send" title="Send" />
</span>

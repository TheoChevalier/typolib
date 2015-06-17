<?php
namespace typolib;

?>
<li>
    <input type="checkbox" id="item-<?=$type_number;?>-<?=$rule_number;?>" class="switch" />
    <label for="item-<?=$type_number;?>-<?=$rule_number;?>" class="rule" data-id-rule="<?=$id_rule;?>" data-id-type="<?=$rule['type']?>">
        <?= Rule::buildRuleString($rule['type'], $rule['content']); ?>
    </label>
    <?php if ($edit_mode) : ?>
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

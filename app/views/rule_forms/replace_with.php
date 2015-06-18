<?php include VIEWS . 'special_characters.php'; ?>
<fieldset>
    <label for="input_1">Replace <input class="droppable" type="text" name="input_1" id="input_1" <?=$edit ? 'value="' . $rule_content[0] . '"' : '' ?>/></label>
</fieldset>
<fieldset>
    <label for="input_2">With <input class="droppable" type="text" name="input_2" id="input_2" <?=$edit ? 'value="' . $rule_content[1] . '"' : '' ?>/></label>
</fieldset>

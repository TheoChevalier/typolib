<?php include VIEWS . 'special_characters.php'; ?>
<fieldset>
    <label for="input_1">Check <input type="text" name="input_1" id="input_1" class="droppable" <?=$edit ? 'value="' . $rule_content[0] . '"' : '' ?>/></label>
</fieldset>
<fieldset>
    <label for="input_2">Before <input type="text" name="input_2" id="input_2" class="droppable" <?=$edit ? 'value="' . $rule_content[1] . '"' : '' ?>/></label>
</fieldset>

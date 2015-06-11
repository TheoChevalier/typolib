<?php include VIEWS . 'key_words.php'; ?>
<fieldset>
    <label for="input_1">Check <input type="text" name="input_1" id="input_1" class="droppable little-input" <?=$edit ? 'value="' . $rule_content[0] . '"' : '' ?>/></label>
</fieldset>
<fieldset>
    <label for="input_2">After <input type="text" name="input_2" id="input_2" class="droppable little-input" <?=$edit ? 'value="' . $rule_content[1] . '"' : '' ?>/></label>
</fieldset>

<li data-id-exception="<?=$id_exception;?>">
    <span><?=$exception?></span>
    <?php if ($edit_mode) : ?>
        <button class="button button-little edit-exception" title="Edit this exception">
            <i class="fa fa-edit"></i>
        </button>
        <button class="button button-red button-little delete-exception close" title="Delete this exception">
            <i class="fa fa-times"></i>
        </button>
    <?php endif; ?>
</li>

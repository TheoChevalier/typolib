<div style="display: block;" id="modal" role="dialog" tabindex="-1">
    <div class="window">
        <div class="inner">
            <header>Typolib’</header>
            <div class="modal-content overlay-contents">
                <?=isset($modal) ? $modal : '';?>
            </div>
            <div title="Close" id="modal-close">
                <a href="#close-modal" class="modal-close-text">Close</a>
                <button type="button" class="button">×</button>
            </div>
        </div>
    </div>
</div>

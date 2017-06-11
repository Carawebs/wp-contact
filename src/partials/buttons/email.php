<?php

?>
<span class="hidden-xs hidden-sm-down">
    <a href="mailto:<?= $email; ?>" class="carawebs-contact button email desktop<?= $desktopClasses; ?>">
        <?= $icon; ?>&nbsp;<?= ! empty( $text ) ? $text . ' ' : NULL; ?>
    </a>
</span>
<span class="hidden-sm hidden-md hidden-lg hidden-md-up">
    <a href="mailto:<?= $email; ?>" class="carawebs-contact button email mobile<?= $mobileClasses; ?>">
        <?= $mobileViewText; ?>
        <?= $icon; ?>
    </a>
</span>

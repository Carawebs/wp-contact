<?php

?>
<span class="hidden-xs hidden-sm-down">
    <a href="mailto:<?= $email; ?>" class="<?= $desktopClasses; ?>">
        <?= $icon; ?>&nbsp;<?= ! empty( $desktop_text ) ? $desktop_text . ' ' : NULL; ?>
    </a>
</span>
<span class="hidden-sm hidden-md hidden-lg hidden-md-up">
    <a href="mailto:<?= $email; ?>" class="<?= $mobileClasses; ?>">
        <?= $mobile_text; ?>
        <?= $icon; ?>
    </a>
</span>

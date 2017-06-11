<?php
/**
 * A partial to output an email link.
 */
?>
<!-- Desktop -->
<span class="contact hidden-xs hidden-sm-down">
    <span class="<?= $desktopClasses; ?>">
        <?= $icon; ?>
        <a href="mailto:<?= $email; ?>" class="<?= $linkClasses; ?>">
            <?= !empty($text) ? $text : NULL; ?>
        </a>
    </span>
</span>
<!-- Mobile -->
<span class="hidden-sm hidden-md hidden-lg hidden-md-up">
    <span class="<?= $mobileClasses; ?>">
        <a href="mailto:<?= $email; ?>" class="<?= $linkClasses; ?>">
            <?= $icon; ?>
            <?= !empty($mobileViewText) ? $mobileViewText : NULL; ?>
        </a>&nbsp;
    </span>
</span>

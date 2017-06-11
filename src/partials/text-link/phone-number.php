<?php
/**
* When viewed on a phone, display a click to call button. On a non phone device,
* show the phone number. Based on screen width rather than
* HTTP headers/user-agent string.
*/

?>
<span class="contact hidden-xs hidden-sm-down">
    <span class="<?= $desktopClasses; ?>">
        <?= $icon; ?><?= ! empty( $desktop_text ) ? $desktop_text . ' ' : NULL; ?><?= $number; ?>
    </span>
</span>
<span class="hidden-sm hidden-md hidden-lg hidden-md-up">
    <a href="tel:<?= $number; ?>" class="<?= $mobileClasses; ?>">
        <?= $icon; ?>
        <span class="phone-text"><?= $mobile_text; ?></span>
    </a>
</span>

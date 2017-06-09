<?php
/**
 * List with contact details.
 *
 */
?>
<hr>
<h2>Hey!</h2>
<ul class="contact-list list-unstyled">
    <?php
    foreach ($output as $key => $content) {
        echo "<li class='$key'>$content</li>";
    }
    ?>
</ul>

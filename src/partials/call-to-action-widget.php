<?php
/**
 * List with contact details.
 *
 */
?>
<ul class="contact-list list-unstyled">
    <?php
    foreach ($contacts as $class => $contact) {
        echo "<li class='$class'>$contact</li>";
    }
    ?>
</ul>

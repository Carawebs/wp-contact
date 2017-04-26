<?php
?>
<ul class="social-follow">
    <?php foreach($socialLinks as $key => $value): ?>
        <li class=<?= $key; ?>>
            <a href=<?= $value['link']; ?>><?= $value['name']; ?></a>
        </li>
    <?php endforeach; ?>
</ul>

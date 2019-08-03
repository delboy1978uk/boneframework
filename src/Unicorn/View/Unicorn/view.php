<?php
use Del\Icon;

/** @var \BoneMvc\Module\Unicorn\Entity\Unicorn $unicorn */
?>
<a href="/unicorn" class="btn btn-default pull-right"><?= Icon::CARET_LEFT ;?> Back</a>

<h1>View Unicorn</h1>
<div class="">
    <h2><?= $unicorn->getName() ?></h2>
</div>
<a href="/unicorn/edit/<?= $unicorn->getId() ?>" class="btn btn-default">
    <?= Icon::EDIT ;?> Edit
</a>

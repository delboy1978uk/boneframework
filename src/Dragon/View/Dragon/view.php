<?php
use Del\Icon;

/** @var \BoneMvc\Module\Dragon\Entity\Dragon $dragon */
?>
<a href="/dragon" class="btn btn-default pull-right"><?= Icon::CARET_LEFT ;?> Back</a>

<h1>View Dragon</h1>
<div class="">
    <h2><?= $dragon->getName() ?></h2>
</div>
<a href="/dragon/edit/<?= $dragon->getId() ?>" class="btn btn-default">
    <?= Icon::EDIT ;?> Edit
</a>

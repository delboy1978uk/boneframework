<?php
use Del\Icon;

/** @var \BoneMvc\Module\Orc\Entity\Orc $orc */
?>
<a href="/orc" class="btn btn-default pull-right"><?= Icon::CARET_LEFT ;?> Back</a>

<h1>View Orc</h1>
<div class="">
    <h2><?= $orc->getName() ?></h2>
</div>
<a href="/orc/edit/<?= $orc->getId() ?>" class="btn btn-default">
    <?= Icon::EDIT ;?> Edit
</a>

<?php

use Bone\View\Helper\AlertBox;
use Del\Icon;

?>
<a href="/dragon/create" class="btn btn-default pull-right"><?= Icon::ADD ;?> Add a Dragon</a>
<h1>OMG! Dragons!</h1>

<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
    <?php
    /** @var \BoneMvc\Module\Dragon\Entity\Dragon $dragon */
    foreach ($dragons as $dragon) { ?>
        <tr>
            <td><?= $dragon->getId() ;?></td>
            <td><?= $dragon->getName() ;?></td>
            <td><a href="/dragon/edit/<?= $dragon->getId() ;?>"><?= Icon::EDIT ;?></a></td>
            <td><a href="/dragon/delete/<?= $dragon->getId() ;?>"><?= Icon::REMOVE ;?></a></td>
        </tr>
    <?php } ?>
    </tbody>

</table>

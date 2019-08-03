<?php
use Del\Icon;
?>
<a href="/orc/create" class="btn btn-default pull-right"><?= Icon::ADD ;?> Add a Orc</a>
<h1>Orc Admin</h1>
<?= $paginator ?>
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
    /** @var \BoneMvc\Module\Orc\Entity\Orc $orc */
    foreach ($orcs as $orc) { ?>
        <tr>
            <td><a href="/orc/<?= $orc->getId() ?>"><?= $orc->getId() ;?></a></td>
            <td><?= $orc->getName() ;?></td>
            <td><a href="/orc/edit/<?= $orc->getId() ?>"><?= Icon::EDIT ;?></a></td>
            <td><a href="/orc/delete/<?= $orc->getId() ?>"><?= Icon::REMOVE ;?></a></td>
        </tr>
    <?php } ?>
    </tbody>

</table>

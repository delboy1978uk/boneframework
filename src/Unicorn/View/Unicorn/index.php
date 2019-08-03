<?php
use Del\Icon;
?>
<a href="/unicorn/create" class="btn btn-default pull-right"><?= Icon::ADD ;?> Add a Unicorn</a>
<h1>Unicorn Admin</h1>
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
    /** @var \BoneMvc\Module\Unicorn\Entity\Unicorn $unicorn */
    foreach ($unicorns as $unicorn) { ?>
        <tr>
            <td><a href="/unicorn/<?= $unicorn->getId() ?>"><?= $unicorn->getId() ;?></a></td>
            <td><?= $unicorn->getName() ;?></td>
            <td><a href="/unicorn/edit/<?= $unicorn->getId() ?>"><?= Icon::EDIT ;?></a></td>
            <td><a href="/unicorn/delete/<?= $unicorn->getId() ?>"><?= Icon::REMOVE ;?></a></td>
        </tr>
    <?php } ?>
    </tbody>

</table>

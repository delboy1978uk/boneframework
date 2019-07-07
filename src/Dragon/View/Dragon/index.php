<?php use Del\Icon; ?>
<a href="/dragon/add" class="btn btn-default pull-right"><?= Icon::ADD ;?> Add a Dragon</a>
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
    <?php foreach ($this->data as $row) { ?>
        <tr>
            <td><?= $row['id'] ;?></td>
            <td><?= $row['name'] ;?></td>
            <td><?= Icon::EDIT ;?></td>
            <td><?= Icon::REMOVE ;?></td>
        </tr>
    <?php } ?>
    </tbody>

</table>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= isset($title) ? $this->e($title) : 'Bone Framework';?></title>
</head>

<body>
<?= $this->section('header'); ?>
<?= $content ;?>
<?= $this->section('footer'); ?>
</body>
</html>








<?php
use Del\Cdn;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= isset($title) ? $this->e($title) : 'Bone MVC Framework';?></title>

    <!-- Bootstrap Core CSS -->
    <?= Cdn::bootstrapCssLink() ;?>
    <?= Cdn::delCssLink() ;?>
    <?= Cdn::fontAwesomeCssLink() ;?>
    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >

    <!-- Fonts -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme CSS -->
    <link href="/css/grayscale.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css"/>

    <!-- Javascript -->
    <?= Cdn::jQueryJavascript() ;?>
    <?= Cdn::bootstrapJavascript() ;?>
    <script src="/js/jquery.datetimepicker.js"></script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<?= $this->section('header'); ?>
<?= $content ;?>
<?= $this->section('footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.tt').tooltip();
        $('.datepicker').datetimepicker({
            "format": "d/m/Y",
            "timepicker": false
        });
        $('.datetimepicker').datetimepicker({
            "format": "d/m/Y H:i",
        });
    });
</script>
</body>
</html>








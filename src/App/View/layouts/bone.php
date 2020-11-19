<?php
use Del\Cdn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= isset($title) ? $this->e($title) : 'Bone Framework';?></title>

    <!-- Bootstrap Core CSS -->
    <?= Cdn::bootstrapCssLink() ;?>
    <?= Cdn::delCssLink() ;?>
    <?= Cdn::fontAwesomeCssLink() ;?>
    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/grayscale.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css"/>
</head>
<body id="page-top">
    <?= $this->section('header'); ?>
    <?= $content ;?>
    <?= $this->section('footer'); ?>


    <!-- Bootstrap core JS-->
    <?= Cdn::jQueryJavascript() ?>
    <?= Cdn::bootstrapJavascript() ?>

    <!-- Third party plugin JS-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="/js/grayscale.js"></script>
</body>
</html>

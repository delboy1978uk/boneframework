<?php

use Del\Cdn;
use Del\Icon;

/** @var \Bone\Server\SiteConfig $config */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">
    <link rel="manifest" href="/img/icons/site.webmanifest">
    <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/img/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <title><?= isset($config) ? $this->e($config->getTitle()) : 'Bone Framework';?></title>

    <!-- Bootstrap Core CSS -->
    <?= Cdn::bootstrapCssLink() ;?>
    <?= Cdn::delCssLink() ;?>
    <?= Cdn::fontAwesomeCssLink('4.7.1') ;?>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/ >
    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <!--Javascript -->
    <?= Cdn::jQueryJavascript() ?>
    <script src="/js/jquery.datetimepicker.js"></script>
</head>
<body class="bg-light">
<section id="nav">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow" id="mainNav">
        <div class="container">
            <strong>
                <a class="navbar-brand js-scroll-trigger" href="/">
                    <img src="/img/skull_and_crossbones_small.png" alt=""/>&nbsp;
                    Bone Framework
                </a>
            </strong>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->l() ?>/#about"><?= $this->t('about') ;?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->l() ?>/#download"><?= $this->t('download') ;?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->l() ?>/#contribute"><?= $this->t('contribute') ;?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->l() ?>/learn"><?= $this->t('learn') ;?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $this->t('language') ;?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/en_PI/">Pirate</a>
                            <a class="dropdown-item" href="/en_GB/">English</a>
                            <a class="dropdown-item" href="/nl_BE/">Nederlands</a>
                            <a class="dropdown-item" href="/fr_BE/">Français</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<main role="main">
    <?= $content ;?>
</main>
<footer class="footer mt-auto py-3 bg-dark text-muted">
    <div class="container">
        <p>© 2020 <?= date('Y') > 2020 ? ' - ' . date('Y') : '' ?> delboy1978uk | <?= Icon::GLOBE ?>
            <a target="_blank" href="//boneframework.delboysplace.co.uk">https://boneframework.delboysplace.co.uk</a> |
            <?= Icon::CERTIFICATE ?> MIT License</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<?= Cdn::bootstrapJavascript() ?>
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

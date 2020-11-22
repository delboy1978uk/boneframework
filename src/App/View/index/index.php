<?php

use Del\Icon;

?>
<section id="home-jumbo" class="jumbotron text-center bg-white">
    <div class="container">
        <img src="/img/skull_and_crossbones.png" />
        <h1 class="jumbotron-heading text-white">Bone Framework</h1>
        <p class="lead text-white">It be yet another PHP framework swashbuckling onto the scene!</p>
    </div>
</section>

<br>
<!-- About-->
<section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-muted"><?= $this->t('about') ;?> Bone</h2>
                <p class="text-muted">Be ye wantin a DIC middleware based framework peppered with local pirate lingo?
                    It be the most awesome framework in the seven seas! Garr!</p>
                <code>composer create-project delboy1978uk/boneframework your/path/here</code>
            </div>
        </div>
        <img class="img-fluid" src="assets/img/ipad.png" alt="" />
    </div>
</section>
<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-industry', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Factory Packages</h3>
                        <p class="card-text">Truly modular package structure utilising PSR-11 DIC factories</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-microchip', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Middleware</h3>
                        <p class="card-text">Create layered middleware applications that use PSR-15 compatible code</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-bolt', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">HTTP Messages</h3>
                        <p class="card-text">Built to consume PSR-7 HTTP messages, simplify your workflow</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-road', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Routing</h3>
                        <p class="card-text">An powerful and easy to use middleware based routing library</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-globe', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Internationalisation</h3>
                        <p class="card-text">Supports i18n out of the box using <br>gettext `.po` files</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <div class="text-center mt20">
                        <?= Icon::custom('fa-terminal', 'fa-5x') ?>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Command Line Interface</h3>
                        <p class="card-text">Create CLI commands in your packages, which register to the bone command</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br>&nbsp;<br>
<!-- Download-->
<section class="projects-section bg-light" id="download">
    <div class="container">
        <!-- Featured Project Row-->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
            <div class="col-xl-6 col-lg-6 text-center">
                <img class="img-fluid mb-3 mb-lg-0" src="/img/pirate.png" alt="" />
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="featured-text text-center text-lg-left">
                    <h2 class="text-muted"><?= $this->t('download') ;?> Bone Framework</h2>
                    <p class="text-muted"><?= $this->t('index.install'); ?><a target="_blank" href="http://getcomposer.org">Composer</a> <?= $this->t('index.install2') ;?></p>
                    <a target="_blank" href="https://github.com/delboy1978uk/boneframework" class="btn btn-primary btn-lg">
                        <i class="fa fa-github"></i> <?= $this->t('visit') ;?> Github
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Signup-->
<section class="signup-section" id="contribute">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">
                <i class="fa fa-github fa-2x mb-2 text-white"></i>
                <h2 class="text-muted"><?= $this->t('contribute') ;?></h2>
                <p class="text-muted"><?= $this->t('index.crew'); ;?> <?= $this->t('index.crew2') ;?><br />
                    <?= $this->t('index.crew3'); ;?></p>
                <p class="text-muted">delboy1978uk@gmail.com</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact-->
<section class="contact-section bg-black">
    <div class="container">
        <div class="social d-flex justify-content-center">
            <i class="fa fa-discord"></i>
            <a class="mx-2" target="_blank" href="//twitter.com/delboy1978uk"><i class="fa fa-2x fa-twitter"></i></a>
            <a class="mx-2" target="_blank" href="//github.com/delboy1978uk/boneframework"><i class="fa fa-2x fa-github"></i></a>
            <a class="mx-2" target="_blank" href="//www.youtube.com/channel/UCBUmyhXk0FvW8S2b4KyCNmw"><i class="fa fa-2x fa-youtube"></i></a>
            <a class="mx-2" target="_blank" href="//delboy1978uk.wordpress.com"><i class="fa fa-2x fa-wordpress"></i></a>
            <a class="mx-2" target="_blank" href="//discord.gg/RB9Fsfk"><i class="fa fa-2x fa-comments"></i></a>
        </div>
    </div>
</section>

<br>&nbsp;<br>
<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50"><div class="container">Bone Framework</div></footer>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Bone Framework</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about"><?= $this->t('about') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#download"><?= $this->t('download') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contribute"><?= $this->t('contribute') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/<?= Locale::getDefault(); ?>/learn"><?= $this->t('learn') ;?></a>
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


<!-- Masthead-->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <img src="/img/skull_and_crossbones.png" />
            <h1 class="mx-auto my-0 text-uppercase">Bone Framework</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5"><?= $this->t('home.intro') ;?></h2>
            <a class="btn btn-primary js-scroll-trigger p0 pl10 pr10" href="#about"><i class="fa fa-5x fa-angle-double-down animated"></i></a>
        </div>
    </div>
</header>


<!-- About-->
<section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white"><?= $this->t('about') ;?> Bone</h2>
                <p class="text-white"><?= $this->t('index.intro') ?></p>
                <code>composer create-project delboy1978uk/boneframework your/path/here dev-master</code>
            </div>
        </div>
        <img class="img-fluid" src="assets/img/ipad.png" alt="" />
    </div>
</section>


<!-- Download-->
<section class="projects-section bg-light" id="download">
    <div class="container">
        <!-- Featured Project Row-->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
            <div class="col-xl-8 col-lg-7 text-center"><img class="img-fluid mb-3 mb-lg-0" src="/img/skull_and_crossbones.png" alt="" /></div>
            <div class="col-xl-4 col-lg-5">
                <div class="featured-text text-center text-lg-left">
                    <h2><?= $this->t('download') ;?> Bone Framework</h2>
                    <p><?= $this->t('index.install'); ?><a target="_blank" href="http://getcomposer.org">Composer</a> <?= $this->t('index.install2') ;?></p>
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
                <h2 class="text-white"><?= $this->t('contribute') ;?></h2>
                <p class="text-white"><?= $this->t('index.crew'); ;?><br /><?= $this->t('index.crew2') ;?><br />
                    <?= $this->t('index.crew3'); ;?></p>
                <p class="text-white">delboy1978uk@gmail.com</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact-->
<section class="contact-section bg-black">
    <div class="container">
        <div class="social d-flex justify-content-center">
            <a class="mx-2" target="_blank" href="https://twitter.com/delboy1978uk"><i class="fa fa-twitter"></i></a>
            <a class="mx-2" target="_blank" href="https://github.com/delboy1978uk/boneframework"><i class="fa fa-github"></i></a>
            <a class="mx-2" target="_blank" href="https://www.youtube.com/channel/UCBUmyhXk0FvW8S2b4KyCNmw"><i class="fa fa-youtube"></i></a>
            <a class="mx-2" target="_blank" href="http://delboy1978uk.wordpress.com"><i class="fa fa-wordpress"></i></a>
        </div>
    </div>
</section>


<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50"><div class="container">Bone Framework</div></footer>

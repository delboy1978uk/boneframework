<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top">
                <i class="fa fa-play-circle"></i>  <span class="light">Bone</span> MVC Framework
            </a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="#about"><?= $this->t('about') ;?></a>
                </li>
                <li class="page-scroll">
                    <a href="#download"><?= $this->t('download') ;?></a>
                </li>
                <li class="page-scroll">
                    <a href="#contribute"><?= $this->t('contribute') ;?></a>
                </li>
                <li class="">
                    <a href="/<?= $this->e($locale)?>/learn"><?= $this->t('learn') ;?></a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->t('language') ;?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/en_PI">Pirate</a></li>
                        <li><a href="/en_GB">English</a></li>
                        <li><a href="/nl_BE">Nederlands</a></li>
                        <li><a href="/fr_BE">Français</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<section class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <img src="/img/skull_and_crossbones.png" />
                    <h1 class="brand-heading">Bone MVC Framework</h1>
                    <p class="intro-text"><?= $this->t('home.intro') ;?></p>
                    <div class="page-scroll">
                        <a href="#about" class="btn btn-circle">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2><?= $this->t('about') ;?> Bone</h2>
            <p><?= $this->t('index.intro') ?></p>
            <code>composer create-project delboy1978uk/bonemvc your/path/here dev-master</code>
        </div>
    </div>
</section>

<section id="download" class="content-section text-center">
    <div class="download-section">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <h2><?= $this->t('download') ;?> Bone MVC</h2>
                <p><?= $this->t('index.install'); ?><a target="_blank" href="http://getcomposer.org">Composer</a> <?= $this->t('index.install2') ;?></p>
                <a target="_blank" href="https://github.com/delboy1978uk/bonemvc" class="btn btn-default btn-lg"><i class="fa fa-github"></i> <?= $this->t('visit') ;?> Github</a>
            </div>
        </div>
    </div>
</section>

<section id="contribute" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2><?= $this->t('contribute') ;?></h2>
            <p><?= $this->t('index.crew'); ;?><br /><?= $this->t('index.crew2') ;?><br />
                <?= $this->t('index.crew3'); ;?></p>
            <p>delboy1978uk@gmail.com</p>
            <ul class="list-inline banner-social-buttons ">
                <li><a target="_blank" href="https://twitter.com/delboy1978uk" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                </li>
                <li><a target="_blank" href="https://github.com/delboy1978uk/bonemvc" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                </li>
                <li><a target="_blank" href="http://delboy1978uk.wordpress.com" class="btn btn-default btn-lg"><i class="fa fa-wordpress"></i> <span class="network-name">Wordpress</span></a>
                </li>
            </ul>
            <div class="mt50 mb50"><br />&nbsp;<br />&nbsp;<br />&nbsp;<br /></div>
        </div>
    </div>
</section>

<!-- Core JavaScript Files -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/js/grayscale.js"></script>

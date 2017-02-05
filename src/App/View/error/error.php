<section class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <img src="/img/skull_and_crossbones.png" />
                    <h1 class="brand-heading">Shiver Me Timbers</h1>
                    <p class="intro-text">Error <?= $this->e($code) ;?> - <?= $this->e($message) ;?></p>
                    <div class="text-left">
                        <?php var_dump($trace); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

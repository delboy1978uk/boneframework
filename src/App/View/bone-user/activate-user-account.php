<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;Activate Account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/user">User</a></li>
                        <li class="breadcrumb-item active">Activate Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?= null !== $message ?  $this->alert($message) : '' ?>
    <section id="login-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="login-logo"><img  alt="Logo" src="<?= $logo ?>"/></div>
                        <?php if (!$message) { ?>
                            <h1><?= $this->t('activate.h1', 'user') ?></h1>
                            <p class="lead"><?= $this->t('activate.p', 'user') ?></p>
                            <div>
                                <a href="<?= $loginRedirect ?>" class="btn btn-primary"><?= \Del\Icon::PAPER_PLANE ?> <?= $this->t('activate.start', 'user') ?></a>
                                <br>&nbsp;
                            </div>
                        <?php } else { ?>
                            <h1><?= $this->t('oops', 'user') ?></h1>
                            <p class="lead"><?= $this->t('problem', 'user') ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
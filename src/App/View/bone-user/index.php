<?php /** @var bool $canRegister */ ?>
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;User Home</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="login-box">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <p class="lead"><?= $this->t('user.welcome', 'user') ?></p>
                    <a href="<?= $this->l() ?>/user/login"
                    class="btn btn-success"><?= \Del\Icon::FORWARD; ?> <?= $this->t('user.login', 'user') ?></a>
                    <?php if ($canRegister) { ?>
                        <a href="<?= $this->l() ?>/user/register"
                           class="btn btn-primary"><?= \Del\Icon::EDIT; ?> <?= $this->t('user.register', 'user') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php use Del\Icon; ?>
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;<?= $this->t('resetpass.h1', 'user') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><?= $this->t('resetpass.h1', 'user') ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?= isset($message) ? $this->alert($message) : '' ?>

    <div class="row justify-content-md-center">
        <div class="login-box col-md-6">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <?= Icon::custom(Icon::ENVELOPE, 'fa-2x'); ?>
                    </div>
                    <br>&nbsp;
                    <p class="lead pt10"><?= $this->t('resetpass.lead', 'user') ?></p>
                    <p><?= $this->t('resetpass.p', 'user') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

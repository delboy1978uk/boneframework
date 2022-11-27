<?php use Del\Icon; ?>
<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;<?= $this->t('changeemail.h1', 'user') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="/">Home</a></li>
                        <li class="breadcrumb-item "><a href="/user">User</a></li>
                        <li class="breadcrumb-item active"><?= $this->t('changeemail.h1', 'user') ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?= isset($message) ? $this->alert($message) : '' ?>

    <div class="row justify-content-md-center">
        <div class="login-box col-md-8">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <?php if (isset($form)) { ?>
                        <p class="lead"><?= $this->t('changeemail.p', 'user') ?></p>
                        <?= $form->render();
                    } else { ?>
                        <p class="lead"><?= $this->t('changeemail.check', 'user') ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


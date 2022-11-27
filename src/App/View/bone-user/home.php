<?php
/** @var \Del\Entity\UserInterface $user */
$name = $user->getPerson()->getFirstname() ?: $user->getEmail()
?>
<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;<?= $this->t('home.welcome', 'user') . $name ?></h1>
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
    <?= null !== $message ? $this->alert($message) : null ?>
    <div class="row justify-content-md-center">
        <div class="login-box col">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <p class="lead"><?= $this->t('home.placeholder', 'user') ?></p>
                    <a class="btn btn-success" href="/user/edit-profile"><?= $this->t('home.editprofile', 'user') ?></a>
                    <a class="btn btn-primary" href="/user/change-email"><?= $this->t('home.changeemail', 'user') ?></a>
                    <a class="btn btn-warning" href="/user/change-password"><?= $this->t('home.changepass', 'user') ?></a>
                    <a class="btn btn-danger" href="/user/logout"><?= $this->t('home.logout', 'user') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

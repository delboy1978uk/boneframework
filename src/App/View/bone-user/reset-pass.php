<script type="text/javascript" src="/bone-user/js/jquery.pstrength-min.1.2.js"></script>
<script type="text/javascript" src="/bone-user/js/register.js"></script>
<link rel="stylesheet" href="/bone-user/css/password-strength.css"/>
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
        <div class="login-box">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <?php
                    if ($success) { ?>
                        <p class="lead"><?= $this->t('resetpass.success', 'user') ?></p>
                        <a class="btn btn-success" href="/user/home"><?= $this->t('continue', 'user') ?></a>
                    <?php } else { ?>
                        <p class="lead"><?= $this->t('changepass.choose', 'user') ?></p>
                        <?= $form->render();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

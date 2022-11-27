<div class="container">
    <?= isset($message) ? $this->alert($message) : null ?>
    <div class="row justify-content-md-center">
        <div class="login- col-md-8">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <br>
                    <?= $form->render(); ?>
                    <?php if (isset($email)) { ?>
                        <a class="pull-left"
                           href="/user/forgot-password/<?= $this->e($email); ?>"><?= $this->t('login.a', 'user') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

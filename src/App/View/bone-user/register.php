<script type="text/javascript" src="/bone-user/js/jquery.pstrength-min.1.2.js"></script>
<script type="text/javascript" src="/bone-user/js/register.js"></script>
<link rel="stylesheet" href="/bone-user/css/password-strength.css"/>

<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= \Del\Icon::HOME ?>&nbsp;&nbsp;Register</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/user">User</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?= null !== $message ? $this->alert($message) : '' ?>

    <div class="row justify-content-md-center">
        <div class="login-box col-md-8">
            <div class="card text-center">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <img alt="Logo" src="<?= $logo ?>"/>
                    </div>
                    <p class="lead"><?= $this->t('user.register', 'user'); ?></p>
                    <?= $form->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
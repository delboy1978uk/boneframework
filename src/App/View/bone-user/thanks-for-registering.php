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

    <section id="login-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="login-logo"><img  alt="Logo" src="<?= $logo ?>"/></div>
                        <p class="lead"><?= $this->t('register.thanks', 'user') ?></p>
                        <p><?= $this->t('register.check', 'user') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

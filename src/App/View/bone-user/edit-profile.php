<?php

use Del\Icon;

/** @var Del\Entity\Person $p */
$p = $person;
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= Icon::HOME ?>&nbsp;&nbsp;<?= $this->t('editprofile.h1', 'user') ?></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/user">User</a></li>
                    <li class="breadcrumb-item active"><?= $this->t('editprofile.h1', 'user') ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <?= isset($message) ? $this->alert($message) : '' ?>
                <div id="alert" class="alert alert-info alert-dismissible" role="alert">
                    <?= $this->t('editprofile.alert', 'user') ?>
                </div>
                <form action="" method="post">
                    <div id="existing-avatar" class="<?= $p->getImage() ? null : 'hide'; ?>">
                        <img id="my-avatar" src="/api/user/avatar" alt="<?= $p->getAka(); ?>"
                             class="m20 img-responsive rounded-circle"/>
                        <button id="change-avatar" type="button"
                                class="btn btn-primary"><?= $this->t('avatar.change', 'user') ?></button>
                    </div>

                    <div id="change-existing" class="<?= $p->getImage() ? 'hide' : null; ?>">
                        <div class="btn-group" role="group" aria-label="...">
                            <button id="choose-pic" type="button"
                                    class="btn btn-primary disabled"><?= $this->t('avatar.choose', 'user') ?></button>
                            <button id="upload-pic" type="button"
                                    class="btn btn-primary"><?= $this->t('avatar.upload', 'user') ?></button>
                        </div>


                        <div id="choose-avatar">
                            <p class="lead tc mt20"><?= $this->t('picture.choose', 'user') ?></p>
                            <div class="row">
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/dog.png" alt="Dog"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/cat.png" alt="Cat"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/gorilla.png" alt="Gorilla"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/lion.png" alt="Lion"
                                         class="img-responsive centered avatar"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/koala.png" alt="Koala"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/rabbit.png" alt="Rabbit"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20">
                                    <img src="/bone-user/img/avatars/tiger.png" alt="Tiger"
                                         class="img-responsive centered avatar"/>
                                </div>
                                <div class="col-md-3 tc mb20 ">
                                    <img src="/bone-user/img/avatars/fox.png" alt="Fox"
                                         class="img-responsive centered avatar"/>
                                </div>
                            </div>
                            <p><small><?= $this->t('avatar.freepik', 'user') ?>(<a target="_blank"
                                                                                   href="//www.freepik.com/free-photos-vectors/design"><?= $this->t('avatar.design', 'user') ?></a>)</small>
                            </p>
                        </div>


                        <div id="upload-my-own" class="hide mt20">
                            <div class="input-group">
                                <span id="choosefile" class="input-group-prepend">
                                    <label for="avatar" class="btn btn-primary btn-file">
                                        <?= $this->t('avatar.browse', 'user') ?>
                                        <input class="form-control-file hide" type="file" name="avatar" id="avatar"/>
                                    </label>
                                </span>
                                <input type="text" class="form-control" readonly/>
                                <span class="input-group-append">
                                    <label id="upload" class="btn btn-primary disabled">
                                        <?= $this->t('avatar.uploadbtn', 'user') ?>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>


                    <br>


                </form>
                <?= $form ?>
                <a id="home-button" href="/" class="btn btn-lg btn-success <?= ($p->getImage() && $p->getAka())
                    ? null : 'disabled'; ?> pull-right"><?= $this->t('home', 'user') ?></a>

            </div>
        </div>
    </div>
</section>
<?php /** @var Del\Entity\Person $p */
$p = $person; ?>


<script type="text/javascript">

    // BOOTSTRAP STYLE FILE INPUT
    $(document).on('change', '.btn-file :file', function () {
        var input = $('#avatar');
        numFiles = input.get(0).files ? input.get(0).files.length : 1;
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function () {


        // BOOTSTRAP STYLE FILE INPUT
        $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
                $('#upload').removeClass('disabled');
            } else if (log) {
                alert(log);
            }
        });


        // Choose Avatar or Upload Image
        var set_avatar = '<?= $p->getImage();?>';
        $('#upload-pic').click(function (e) {
            $(this).addClass('disabled');
            $('#choose-pic').removeClass('disabled').removeClass('btn-default').addClass('btn-primary');
            $('#choose-avatar').addClass('hide');
            $('#upload-my-own').removeClass('hide');
        });
        $('#choose-pic').click(function (e) {
            $(this).addClass('disabled');
            $('#upload-pic').removeClass('disabled').removeClass('btn-default').addClass('btn-primary');
            $('#upload-my-own').addClass('hide');
            $('#choose-avatar').removeClass('hide');
        });


        // Change Avatar
        $('#change-avatar').click(function () {
            $('#existing-avatar').addClass('hide');
            $('#change-existing').removeClass('hide');
        });


        // Choose Avatar
        $('img.avatar').click(function () {
            var src = $(this).prop('src');
            var replace = location.protocol + '//' + location.host;
            var avatar = src.replace(replace, '');
            $.post('/api/user/choose-avatar', {avatar: avatar}, function (result) {
                var alertbox = $('#alert');
                alertbox.removeClass('alert-danger');
                alertbox.removeClass('alert-info');
                alertbox.removeClass('alert-success');
                alertbox.addClass('alert-' + result.result);
                alertbox.html(result.message);
                if (result.result == 'success') {
                    d = new Date();
                    set_avatar = result.avatar;
                    $('#image').val(set_avatar);
                    $('#user-avatar').prop('src', set_avatar);
                    $('#my-avatar').prop('src', '/api/user/avatar?' + d.getTime());
                    $('#existing-avatar').removeClass('hide');
                    $('#change-existing').addClass('hide');
                }
            });
        });


        // AJAX UPLOAD
        $('#upload').click(function (e) {
            var jform = new FormData();
            jform.append('avatar', $('#avatar').get(0).files[0]);

            $.ajax({
                url: '/api/user/upload-avatar',
                type: 'POST',
                data: jform,
                dataType: 'json',
                mimeType: 'multipart/form-data',
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    var alertbox = $('#alert');
                    alertbox.removeClass('alert-danger');
                    alertbox.removeClass('alert-info');
                    alertbox.removeClass('alert-success');
                    alertbox.addClass('alert-' + result.result);
                    alertbox.html(result.message);
                    if (result.result == 'success') {
                        d = new Date();
                        set_avatar = result.avatar
                        $('#image').val(set_avatar);
                        $('#my-avatar').prop('src', '/api/user/avatar?' + d.getTime()).addClass('img-circle');
                        $('#user-avatar').prop('src', '/img/' + set_avatar);
                        $('#existing-avatar').removeClass('hide');
                        $('#change-existing').addClass('hide');
                    }
                },
                error: function (jqXHR, status, error) {
                    // Hopefully we should never reach here
                }
            });
        });
    });
</script>
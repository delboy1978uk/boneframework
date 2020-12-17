<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>500 Error Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">500 Error Page</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
            <h3><i class="fa fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>
            <?php if (APPLICATION_ENV === 'development') { ?>
            <p class="lead intro-text">Error <?= $this->e($code) ;?> - <?= $this->e($message) ;?></p>
            <p class="intro-text">in
                <a href="phpstorm://open?file=<?= str_replace('/var/www/html/', APPLICATION_PATH . '/' , $this->e($file)) . '&line=' . $this->e($line) ?>">
                    <?= str_replace('/var/www/html/', '' , $this->e($file)) ;?>
                </a> at line <?= $this->e($line) ?></p>
            <?php } ?>
            <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href="/">return home</a> or try using the search form.
            </p>

            <form class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
<br>&nbsp;<br>

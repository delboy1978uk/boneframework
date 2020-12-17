<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>401 Error Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">401 Error Page</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="error-page">
        <h2 class="headline text-danger"> 401</h2>

        <div class="error-content">
            <h3><i class="fa fa-exclamation-triangle text-danger"></i> Unauthenticated.</h3>

            <p>
                You must log in before you might have permission to perform that action. <a href="/">return home</a> or try using the search form.
            </p>

            <form class="search-form" method="post" action="/user/login">
                <div class="input-group">
                    <input type="text" name="email" class="form-control" placeholder="email..">

                    <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-envelope"><i class="fa fa-envelope"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="password ..">

                    <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-envelope"><i class="fa fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <br>
                <div class="input-group">
                    <input type="submit" name="submit" class="form-control btn-danger pull-right" value="Sign In">
                </div>
                <div class="input-group-append">
                   
                </div>
                <!-- /.input-group -->
            </form>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<br>&nbsp;<br>
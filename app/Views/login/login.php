<!DOCTYPE html>
<html>
<?php

/**
 * @var string $tittle
 */
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $tittle; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?= $this->include('layout/header_head'); ?>

</head>


<body>


    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center mt-0 m-b-15">
                    <a href="" class="logo logo-admin"><img src="assets/images/logo.png" height="44" alt="logo"></a>
                </h3>

                <div class="p-3">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <form class="form-horizontal m-t-20" action="<?= site_url('Auth/proses_login') ?>" method="POST">

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" required="" placeholder="Username" name="username" value="<?= session()->getFlashdata('username') ? session()->getFlashdata('username') : '' ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password">
                            </div>
                        </div>


                        <div class="form-group text-center row m-t-20">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?= $this->include('layout/footer_js'); ?>

</body>

</html>
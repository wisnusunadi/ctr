<body class="hold-transition login-page">
    <?php
    $session = session();
    $error = $session->getFlashdata('error');
    ?>

    <?php if ($error) { ?>
        <p style="color:red">Terjadi Kesalahan:
        <ul>
            <?php foreach ($error as $e) { ?>
                <li><?php echo $e ?></li>
            <?php } ?>
        </ul>
        </p>
    <?php } ?>
    <div class="login-box">
        <div class="login-logo">
            <b>Sistem Informasi</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Register Akun</p>

                <form action="/register" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama" name="nama">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="confirm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <a href="/">Punya Akun ?</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
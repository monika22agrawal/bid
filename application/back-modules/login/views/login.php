<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/AdminLTE.min.css">
        <!-- Material Design -->
        <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/bootstrap-material-design.min.css">
        <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/ripples.min.css">
        <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/MaterialAdminLTE.min.css">
        <link rel="shortcut icon" href="<?php echo base_url().ADMIN_THEME;?>asset/img/logo.png">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
            <a><b>Admin</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if(!empty($error)):?>                            
                    <div class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $error;?>
                    </div>
                <?php endif;?>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $this->input->cookie('email', TRUE); ?>" autcomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $this->input->cookie('password', TRUE); ?>" autcomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="checkbox">
                                <label><input type="checkbox" name="rem" value="1" <?php if($this->input->cookie('email',true)){ ?>checked <?php } ?>> Remember Me</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-5">
                            <button type="submit" class="btn btn-primary btn-raised btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url().ADMIN_THEME;?>asset/bootstrap/js/bootstrap.min.js"></script>
        <!-- Material Design -->
        <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/material.min.js"></script>
        <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/ripples.min.js"></script>
        <script>
            $.material.init();
        </script>
    </body>
</html>

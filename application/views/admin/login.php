
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SATS Login | Admin</title> 
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo media_url('ico/favicon.jpg'); ?>" type="image/x-icon">
    <!-- CSS Style -->
    <link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo media_url() ?>/css/design.css" rel="stylesheet" type="text/css">
    <link href="<?php echo media_url() ?>/css/load-font.css" rel="stylesheet" type="text/css">
    <link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Javascript -->
    
    <script src="<?php echo media_url() ?>/js/jquery-3.2.0.min.js"></script>
    <script src="<?php echo media_url() ?>/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
    
    <script src="<?php echo media_url() ?>/js/design.js"></script>
    <script src="<?php echo media_url() ?>/js/design.min.js"></script>
    <!-- Theme initialization --> 
    
</head>

<body>
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <!-- <div class="navbar-header">
                <a class="navbar-brand" href=" #"><img src="<?php echo media_url() ?>/img/back.png" height="100px" width="260px"></a>
            </div> -->
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="<?php echo media_url() ?>/img/lock.jpeg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <div class="card card-login">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="card-title">SMK Wirabuana</h4>       
                                </div>
                                <p class="category text-center">
                                    Dear user login here!
                                </p>
                                <div class="card-content">
                                    <?php echo form_open('admin/auth/login'); ?>
                                    <?php
                                    if (isset($_GET['location'])) {
                                        echo '<input type="hidden" name="location" value="';
                                        if (isset($_GET['location'])) {
                                            echo htmlspecialchars($_GET['location']);
                                        }
                                        echo '" />';
                                    } ?>
                                    <!-- Jika Error -->
                                    <?php if ($this->session->flashdata('failed')) { ?>
                                    <div class="danger">
                                        <center><p><i class="material-icons text-danger">warning</i> <?php echo $this->session->flashdata('failed') ?></p></center>
                                    </div>
                                    <?php } ?>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Username</label>
                                            <input type="text" autofocus name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-info btn-wd btn-lg">Login</button>  
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="text-xs-center">
                            <center><span class="btn btn-info rounded btn-sm">Copyright &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved</span>
                            </div></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
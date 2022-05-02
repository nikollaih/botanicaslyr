<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.themeturka.com/fixed-plus/layouts-1/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 22:25:14 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Consultorio</title>

        <!-- Common Plugins -->
        <link href="<?php echo base_url() ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Css-->
        <link href="<?php echo base_url() ?>/assets/scss/style.css" rel="stylesheet">
		
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var base_url = "<?php echo base_url() ?>";
        </script>
        <style type="text/css">
            html,body{
                height: 100%;
            }
        </style>
    </head>
    <body class="bg-light">

        <div class="misc-wrapper">
            <div class="misc-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4">
                              <div class="misc-header text-center">
								<img width="150px" alt="" src="<?php echo base_url() ?>/assets/img/logo.png" class="logo-icon margin-r-10">
                            </div>
                            <div class="misc-box">   
                                <form id="form-login" role="form">
                                    <div class="form-group">                                      
                                        <label  for="exampleuser1">Nombre de usuario</label>
                                        <div class="group-icon">
                                        <input name="user" type="text" class="form-control required" required="">
                                        <span class="icon-user text-muted icon-input"></span>
                                        </div>
                                        <span class="input-error">Este campo es requerido</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Contraseña</label>
                                        <div class="group-icon">
                                        <input name="password" type="password" class="form-control required">
                                        <span class="icon-lock text-muted icon-input"></span>
                                        </div>
                                        <span class="input-error">Este campo es requerido</span>
                                    </div>
                                    <div class="clearfix">
                                        <div class="float-left">
                                           <label> ¿Olvidaste tu contraseña? </label>
                                        </div>
                                        <div class="float-right">
                                            <a id="login-btn" class="btn btn-block btn-primary btn-rounded box-shadow">Entrar</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="form-error"></p>
                                    <!-- <p class="text-center">Need to Signup?</p>
                                    <a href="page-register.html" class="btn btn-block btn-success btn-rounded box-shadow">Register Now</a> -->
                                </form>
                            </div>
                            <div class="text-center misc-footer">
                               <!-- <p>Copyright &copy; 2018 FixedPlus</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Common Plugins -->
        <script src="<?php echo base_url() ?>/assets/lib/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/lib/metisMenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/auth.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/helper.js"></script>
    </body>

<!-- Mirrored from www.themeturka.com/fixed-plus/layouts-1/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 22:25:14 GMT -->
</html>

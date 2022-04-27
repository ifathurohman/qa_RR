<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
      <meta name="author" content="Coderthemes">
      <title>Rumah RUTH - Login</title>
      <link rel="shortcut icon" href="aset/img/favicon.ico">
      <link href="<?= base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("assets/css/core.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("assets/css/components.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("assets/css/icons.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("assets/css/pages.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("assets/css/responsive.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("aset/plugin/sweetalert/sweetalert.css"); ?>" rel="stylesheet" type="text/css" />
      <link href="<?= base_url("aset/css/custom.css"); ?>" rel="stylesheet" type="text/css" />
      <script src="<?= base_url("aset/js/jquery-2.1.4.min.js"); ?>"></script>
      <script src="<?= base_url("aset/plugin/sweetalert/sweetalert.min.js"); ?>"></script>
   </head>
   <body class="page-data" data-category="<?= $category; ?>">
      <div class="account-pages"></div>
      <div class="clearfix"></div>
      <div class="wrapper-page">
      <?php if($category == "login"): ?>
         <div class=" card-box">
            <div class="panel-heading">
               <h3 class="text-center"> Sign In to <a href="<?= site_url(); ?>"><img src="<?= $this->main->set_('Logo'); ?>" height="30"/></a></h3>
            </div>
            <div class="panel-body">
               <form id="form-login" class="form-horizontal m-t-20">
                  <div class="form-group ">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Email Address</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input name="Email" class="form-control" type="text" placeholder="Email Address">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Password</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                           <input name="Password" class="form-control" type="password" placeholder="Password">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group text-center m-t-40">
                     <div class="col-xs-12">
                        <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit" id="btn-login">Log In</button>
                     </div>
                  </div>
                  <div class="form-group m-t-30 m-b-0">
                     <div class="col-sm-12">
                        <a href="<?= site_url("forgot-password"); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>

<!--          <div class="row">
            <div class="col-sm-12 text-center">
               <p>Don't have an account? <a href="<?= site_url("register"); ?>" class="text-primary m-l-5"><b>Sign Up</b></a></p>
            </div>
         </div> -->
      <?php endif; ?>
      <?php if($category == "register"): ?>

         <div class=" card-box">
            <div class="panel-heading">
               <h3 class="text-center"> Sign Up to <strong class="text-custom">UBold</strong> </h3>
            </div>
            <div class="panel-body">
               <form id="form-login" class="form-horizontal m-t-20">
                  <div class="form-group ">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Email Address</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input name="Email" class="form-control" type="text" required="" placeholder="Email Address">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Password</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                           <input name="Password" class="form-control" type="text" required="" placeholder="Password">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group text-center m-t-40">
                     <div class="col-xs-12">
                        <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit" id="btn-login">Log In</button>
                     </div>
                  </div>
                  <div class="form-group m-t-30 m-b-0">
                     <div class="col-sm-12">
                        <a href="<?= site_url("login"); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Back to sign in</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      <?php endif; ?>
      <?php if($category == "forgot_password"): ?>

         <div class=" card-box">
            <div class="panel-heading">
               <h3 class="text-center"> Forgot <strong class="text-custom">Password</strong></h3>
               <!-- <p>Enter your e-mail address below and we will send you instructions how to recover a password.</p> -->
            </div>
            <div class="panel-body">
               <form id="form-login" class="form-horizontal m-t-20">
                  <div class="form-group ">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Email Address</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input name="Email" class="form-control" type="text" placeholder="Email Address">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group text-center m-t-40">
                     <div class="col-xs-12">
                        <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit" id="btn-login">Send Email</button>
                     </div>
                  </div>
                  <div class="form-group m-t-30 m-b-0">
                     <div class="col-sm-12">
                        <a href="<?= site_url("login"); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Back to sign in</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      <?php elseif($category == "reset_password"): ?>

         <div class=" card-box">
            <div class="panel-heading">
               <h3 class="text-center"> Reset <strong class="text-custom">Password</strong></h3>
               <!-- <p>Enter your e-mail address below and we will send you instructions how to recover a password.</p> -->
            </div>
            <div class="panel-body">
               <form id="form-login" class="form-horizontal m-t-20">
                  <input type="hidden" name="UserID" value="<?= $UserID; ?>">
                  <input type="hidden" name="Email" value="<?= $Email; ?>">
                  <input type="hidden" name="Token" value="<?= $Token; ?>">
                  <div class="form-group ">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Email Address</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input name="Password" class="form-control" type="password" placeholder="New Password">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="col-xs-12">
                        <!-- <label class="control-label">Email Address</label> -->
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           <input name="PasswordConfirmation" class="form-control" type="password" placeholder="Confirmation Password">
                        </div>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group text-center m-t-40">
                     <div class="col-xs-12">
                        <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit" id="btn-login">Save Password</button>
                     </div>
                  </div>
                  <div class="form-group m-t-30 m-b-0">
                     <div class="col-sm-12">
                        <a href="<?= site_url("login"); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Back to sign in</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      <?php endif; ?>
      </div>
     <script src="<?= base_url("aset/js/jquery.min.js"); ?>"></script>
     <script src="<?= base_url("aset/js/bootstrap.min.js"); ?>"></script>
     <script src="<?= base_url("aset/js/backend/login.js"); ?>"></script>
   </body>
</html>
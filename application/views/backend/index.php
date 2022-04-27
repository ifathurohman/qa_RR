<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Discovery Property">
      <meta name="author" content="Discovery">
      <title><?= $title; ?></title>
      <?php $this->load->view("backend/css"); ?>
   </head>
   <body class="fixed-left backend">
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Top Bar Start -->
         <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
               <div class="text-center">
                  <a href="<?= site_url(); ?>" class="logo">
                  <i class="icon-c-logo"> <img src="<?= $this->main->set_('Logo'); ?>" height="40"/> </i>
                  <span><img src="<?= $this->main->set_('Logo'); ?>" height="40"/></span>
                  </a>
               </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <?php $this->load->view("backend/menu-navbar"); ?>
         </div>
         <!-- Top Bar End -->
         <!-- ========== Left Sidebar Start ========== -->
         <?php $this->load->view("backend/menu-sidebar"); ?>
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container">
                  <?php $this->load->view($content); ?>
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            <footer class="footer">
               © 2018. All rights reserved.
            </footer>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
         <!-- Right Sidebar -->
         
         <!-- /Right-bar -->
      </div>
      <!-- END wrapper -->
      <?php $this->load->view("backend/js"); ?>
      <?php $this->load->view("backend/plugins"); ?>
   </body>
</html>
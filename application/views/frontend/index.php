<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="RC Electronic">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="ii_QH3Sf4OziEWii-wHlfIhL92CH3jAJFeqH9et7eh8" />
    <?php 
    if (isset($meta)):
        echo $meta;
    else:
    ?>
        <meta name="description" content="Rumah ruth (Yayasan Rumah Tumbuh Harapan) Dimulai dari kerinduan melihat kehidupan orang-orang diubahkan, dan visi yang Tuhan taruh didalam hati dan mimpi.">
        <meta name="keywords" content="Rumah ruth (Yayasan Rumah Tumbuh Harapan) Dimulai dari kerinduan melihat kehidupan orang-orang diubahkan, dan visi yang Tuhan taruh didalam hati dan mimpi.">
    <?php endif; ?>
    <?php $this->load->view("frontend/aset_css"); ?>
    <script src="<?= base_url('/aset/js/jquery-2.1.4.min.js'); ?>"></script>
  </head>
  <body  class="frontend page-data" data-bahasa="<?= $this->session->bahasa; ?>" data-app="frontend">
    <?php $this->load->view("frontend/navbar"); ?>
    <div class="body-content">
    <?php $this->load->view($content);?>
    </div>
    <!-- Footer -->
    <?php $this->load->view("frontend/footer"); ?>
    <!-- Bootstrap core JavaScript -->
    <?php $this->load->view("frontend/aset_js"); ?>
    <!-- <script src="<?= site_url("aset/js/bootstrap.min.js"); ?>"></script> -->
  </body>
</html>

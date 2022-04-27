<div class="row page page-data" data-hakakses2="<?= $hakakses ?>" data-hakakses="<?= $this->session->HakAkses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>">
   <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#">Master</a>
         </li>
         <li>
            <a href="<?= site_url($url_modul) ?>"><?= $title; ?></a>
         </li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="div-table">
         <div class="panel panel-color panel-custom">
          <div class="panel-heading">
            <h3 class="panel-title">List Data</h3>
          </div>
          <div class="panel-body table-responsive">
            <?php $this->load->view($filter); ?>
            <div class="div-btn btn-group">
                <?= $tambah; ?>
            </div>
            <div class="div-btn btn-group pull-right">
              <button class="btn btn-outline btn-white" onclick="reload_table()" type="button">Reload</button>
              <button class="btn btn-outline btn-white" onclick="filter_table()" type="button">Search</button>
            </div>
             <table id="table" class="table  width-full" data-plugin="dataTable" cellspacing="0" width="100%">
              <thead>
                 <tr>
                    <th>No</th>
                    <th>Subjek</th>
                    <th>Pengirim</th>
                    <th>Tanggal Kirim</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th style="width:125px;">Action</th>
                 </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php $this->load->view($modal); ?>
      <?php $this->load->view($print); ?>
   </div>
</div>
<!-- Plugins For This Page -->
<link href="<?= base_url("aset/plugin/select2/select2.min.css"); ?>" rel="stylesheet" type="text/css" />
<script src="<?= base_url("aset/plugin/select2/select2.min.js"); ?>"></script>
<script src="<?= base_url('aset/js/backend/email_broadcast.js'); ?>"></script>
<link href="<?= base_url('aset/plugin/datepicker/bootstrap-datepicker3.css'); ?>" rel="stylesheet"/>
<script src="<?= base_url('aset/plugin/datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<link href="<?= base_url('aset/plugin/tagsinput/bootstrap-tagsinput.css'); ?>" rel="stylesheet"/>
<script src="<?= base_url('aset/plugin/tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<link href="<?= base_url('aset/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?= base_url('aset/plugin/summernote/summernote.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.summernote').summernote({
      height: 300,
      callbacks: {
          onImageUpload: function(image) {
            uploadImage(image);
          }
      }
    });
  });
</script>

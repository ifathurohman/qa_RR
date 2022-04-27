<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>" data-menuid="<?= $MenuID; ?>">
<!--    <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#">Master</a>
         </li>
         <li>
            <a href="#"><?= $title; ?></a>
         </li>
      </ol>
   </div> -->
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="div-table">
         <div class="panel panel-color panel-custom">
          <div class="panel-heading">
            <h3 class="panel-title">List Data</h3>
          </div>
          <div class="panel-body table-responsive">
            <div class="div-btn btn-group">
                <?= $tambah; ?>
                <button class="btn btn-outline btn-white" onclick="reload_table()" type="button">Reload</button>
             </div>
             <table id="table" class="table table-hovered full-width" style="width: 100%">
                <thead>
                   <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th style="width:50px;">Action</th>
                 </tr>
                </thead>
                  <tbody>
                </tbody>
             </table>
          </div>
        </div>
      </div>
   </div>
</div>

<?php $this->load->view($modal); ?>
<link href="<?= base_url('aset/plugin/dropify/');?>dropify.min.css" rel="stylesheet">
<script src="<?= base_url('aset/plugin/dropify/');?>dropify.min.js"></script>
<script src="<?= base_url('aset/js/backend/users.js'); ?>"></script>
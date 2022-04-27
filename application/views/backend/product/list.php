<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>" data-menuid="<?= $MenuID; ?>">
<!--    <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#">Transaksi</a>
         </li>
         <li>
            <a href="#"><?= $title; ?></a>
         </li>
      </ol>
   </div> -->
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="div-table-list wb-max-width-70">
        <div class="div-btn btn-group">
          <?= $tambah; ?>
        </div>
       <div class="div-btn btn-group pull-right">
          <button class="btn btn-outline btn-white" onclick="reload_table()" type="button">Reload</button>
       </div>
        <table id="table" class="table-list table-hovered full-width table-2-column" style="width: 100%">
          <thead style="display: none;">
             <tr>
              <th>No</th>
              <th>Header</th>
           </tr>
          </thead>
            <tbody>
          </tbody>
       </table>
      </div>
   </div>
</div>
<?php $this->load->view($form); ?>
<!-- Plugins For This Page -->
<link href="<?= base_url('aset/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?= base_url('aset/plugin/summernote/summernote.js'); ?>"></script>
<script src="<?= base_url('aset/js/backend/product.js'); ?>"></script>


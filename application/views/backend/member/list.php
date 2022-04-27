<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>">
   <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#">Master</a>
         </li>
         <li>
            <a href="#"><?= $title; ?></a>
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
            <?php $this->load->view($modal); ?>
            <table id="table" class="table table-striped table-hovered" data-plugin="dataTable" cellspacing="0" width="100%">
                <thead>
                   <tr>
                    <th>No</th>
                    <th>Code</th>
                 <!-- <th>Image</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Subscribe</th>
                    <th>Action</th>
                 </tr>
                </thead>
               <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php $this->load->view($modal); ?>
   </div>
</div>
<!-- Plugins For This Page -->
<script src="<?= base_url('aset/js/backend/member.js'); ?>"></script>
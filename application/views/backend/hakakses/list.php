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
                    <th width="20px">No</th>
                    <th>Name</th>
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
   </div>
</div>
<!-- Plugins For This Page -->
<script src="<?= base_url('aset/js/backend/hakakses.js'); ?>"></script>
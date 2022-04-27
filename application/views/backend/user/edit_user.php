<div class="row">
   <div class="col-sm-12">
      <div class="div-table-list">
         <div class="panel panel-color panel-custom">
          <div class="panel-heading">
            <h3 class="panel-title">Edit User</h3>
          </div>
          <div class="panel-body table-responsive">
            <form id="form" class="form-horizontal" role="form" autocomplete="off">
                <input type="hidden" name="UserID">
                <input type="hidden" name="page" value="user_edit">
                <input type="hidden" name="crud">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label">Image</label>
                            <input type="file" name="gambar" id="gambar" class="dropify" />
                            <span class="help-block"></span>
                            <span>File format (PNG, JPG, JPEG), max size (2MB)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name <span class="wajib"></span>
                        </label>
                        <div class="col-md-8">
                            <input type="text" name="Name" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email Address<span class="wajib"></span>
                        </label>
                        <div class="col-md-8">
                            <input type="text" name="Email" class="form-control" autocomplete="off" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password <span class="wajib"></span>
                        </label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control" autocomplete="off">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Role <span class="wajib"></span>
                        </label>
                        <div class="col-md-8">
                            <input type="hidden" name="role" id="HakAksesID" class="form-control" autocomplete="off">
                            <input type="text" id="hak_akses" class="form-control" autocomplete="off" disabled>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button id="btnSave" type="button" onclick="save('user_edit')" class="btn btn-white  waves-effect"> Save </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
   </div>
</div>
<link href="<?= base_url('aset/plugin/dropify/');?>dropify.min.css" rel="stylesheet">
<script src="<?= base_url('aset/plugin/dropify/');?>dropify.min.js"></script>
<link href="<?php echo base_url();?>aset/plugin/datepicker/bootstrap-datepicker3.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>aset/plugin/datepicker/bootstrap-datepicker.min.js"></script>
<?php if($this->session->MarketingID): ?>
  <script src="<?= base_url('aset/js/backend/Lmaster_marketing.js'); ?>"></script>
  <script>
    $(document).ready(function() {
      edit_data("<?= $this->session->MarketingID ?>",'edit_user');
  });
  </script>
<?php else: ?>
  <script src="<?= base_url('aset/js/backend/users.js'); ?>"></script>
  <script>
    $(document).ready(function() {
      edit("<?= $id ?>");
  });
  </script>
<?php endif; ?>  
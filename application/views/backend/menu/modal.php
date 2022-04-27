<!-- Modal -->
<div id="modal" class="modal fade modal-fade-in-scale-up" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
          <div class="panel panel-color panel-custom">
              <div class="panel-heading"> 
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title modal-title">Modal Title</h3>
              </div> 
              <div class="panel-body"> 
                  <form id="form" autocomplete="off">
                    <input type="hidden" name="MenuID">
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label class="control-label">Name</label>
                        <input name="Name" id="Name" type="text" class="form-control">
                        <span class="help-block"></span>
                      </div>
                      <!-- <div class="form-group col-sm-12">
                        <label class="control-label">Modul</label>
                        <select name="Modul" placeholder="Modul" id="Modul" class="form-control"> 
                            <option value="0">Pilih Modul</option>
                            <option value="1">Akuntansi</option>
                            <option value="2">Listing</option>
                        </select>
                        <span class="help-block"></span>
                      </div> -->
                      <!-- <div class="form-group col-sm-6">
                        <label class="control-label">Type</label>
                        <select name="Type" placeholder="Type" id="Type" class="form-control"> 
                            <option value="1">Main Menu</option>
                            <option value="2">Sub Menu</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-12 v_parent">
                        <label class="control-label">Parent</label>
                        <select name="ParentID" placeholder="ParentID" id="ParentID" class="form-control"> 
                        </select>
                        <span class="help-block"></span>
                      </div> -->
                      <div class="form-group col-sm-12">
                        <label class="control-label">Url</label>
                        <input name="Url" id="Url" type="text" class="form-control">
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label">Root</label>
                        <input name="Root" id="Root" type="text" class="form-control">
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label">Category</label>
                        <select name="Category" placeholder="Category" id="kategori" class="form-control"> 
                            <option value="page_backend">Halaman Backend</option>
                            <option value="page">Page</option>
                            <option value="administrasi">Administration</option>
                            <option value="master">Master</option>
                            <option value="transaction">Transaksi</option>
                            <option value="report">Laporan</option>
                            <option value="setting">Setting</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-12 v_icon">
                        <label class="control-label">Icon</label>
                        <input name="Icon" id="Icon" type="text" class="form-control">
                        <span class="help-block"></span>
                        <a href="<?= site_url('backend/icons'); ?>" target="_blank">Click here to see list icons</a>
                      </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
                  <button id="btnSave" onclick="save()" type="button" class="btn btn-default">Save</button>
                </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div>
</div>

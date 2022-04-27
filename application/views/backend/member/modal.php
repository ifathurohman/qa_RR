<!-- Modal -->
<div id="modal" class="modal fade modal-fade-in-scale-up" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
          <div class="panel panel-color panel-custom">
              <div class="panel-heading"> 
                  <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title modal-title">Modal Title</h3>
              </div> 
              <div class="panel-body"> 
                <form id="form" autocomplete="off" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="MemberID">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label class="control-label">Image</label>
                      <input type="file" name="Image" id="input-file-now" class="dropify"/>
                      <span class="help-block"></span>
                      <span>File size max 1,8mb & format (PNG, JPG, JPEG), best resolution 800x800px</span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Name</label>
                      <input name="Name" id="Name" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                       <div class="form-group col-sm-12">
                      <label class="control-label">Email</label>
                      <input name="Email" id="Email" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12 ">
                      <label class="control-label">Member Type</label>
                      <select name="Member_type" id="member" class="form-control">
                            <option value="none">Select Member Type</option>
                            <option value="1">Partner</option>
                            <option value="2">Client</option>
                            <option value="3">Subscriber</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                     <div class="form-group col-sm-12 vparent_category">
                      <label class="control-label">Category</label>
                       <select name="Category" id="select_category" class="form-control">
                            <option>Select Category</option> 
                            <option>Production</option>
                            <option>Retail</option>
                            <option>Website</option>
                            <option>Payroll</option>
                      </select>
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Link Website</label>
                      <input type="text" name="LinkWebsite" id="LinkWebsite" class="form-control" placeholder="example : https://rcelectronic.co.id">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12 vparent_category">
                      <label class="control-label">Subscribe</label>
                       <select name="Subscribe" id="Subscribe" class="form-control">
                            <option value="1">Subscribe</option> 
                            <option value="0">Unsubscribe</option>
                      </select>
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Key Category</label>
                      <select name="CategoryID" id="CategoryID" class="form-control category_select" data-select="active">
                        <optgroup class="data"></optgroup>
                        <optgroup class="list"></optgroup>
                      </select>
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12 ">
                      <label class="control-label">Remark</label>
                      <input name="Remark" id="Remark" type="remaks" class="form-control">
                      <span class="help-block"></span>
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
<link href="<?= base_url('aset/plugin/dropify/');?>dropify.min.css" rel="stylesheet">
<script src="<?= base_url('aset/plugin/dropify/');?>dropify.min.js"></script>
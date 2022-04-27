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
                  <input type="hidden" name="CategoryID">
                  <input type="hidden" name="crud">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label class="control-label">Name <span class="red">*</span></label>
                      <input name="Name" id="Name" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Key Description</label>
                      <input name="SeoText" id="SeoText" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Key File Name</label>
                      <input name="SeoImage" id="SeoImage" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Remark</label>
                      <input name="Remark" id="Remark" type="text" class="form-control">
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label">Icon</label>
                      <input name="Icon" id="Icon" type="text" class="form-control">
                      <span class="help-block"></span>
                      <a href="<?= site_url('backend/icons'); ?>" target="_blank">Click here to see list icons</a>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
              <div class="btn-group m-b-20 pull-right">
                <a href="javascript:void(0)" onclick="save('close')" class="btn btn-white">Save</a>
<!--                 <div class="btn-group open">
                    <button id="btnSave" type="button" class="btn btn-white dropdown-toggle  waves-effect" data-toggle="dropdown" aria-expanded="true"> Save <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                        <li></li>
                        <li><a href="javascript:void(0)" onclick="save('new')">Save & Add New</a></li>
                    </ul>
                </div>
 -->                <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div><!-- /.modal-content -->
  </div>
</div>
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
               <form id="form" class="form-horizontal" role="form" autocomplete="off">
               <input type="hidden" name="UserID">
               <input type="hidden" name="crud">
               <div class="row">
                  <div class="form-group ">
                      <div class="col-sm-12">
                      <label class="control-label">Image</label>
                      <input type="file" name="gambar" id="gambar" class="dropify" />
                      <span class="help-block"></span>
                      <span>File format (PNG, JPG, JPEG), max size (2MB)</span>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label">Name <span class="wajib"></span></label>
                      <div class="col-md-8">
                        <input type="text" name="Name" class="form-control">
                        <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label">Email Address <span class="wajib"></span></label>
                      <div class="col-md-8">
                        <input type="text" name="Email" class="form-control" autocomplete="off">
                        <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label">Password <span class="wajib"></span></label>
                      <div class="col-md-8">
                        <input type="password" name="password" class="form-control" autocomplete="off">
                        <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label">Role <span class="wajib"></span></label>
                    <div class="col-md-8">
                        <select name="role" id="role" class="form-control select2">
                            <option value="none">Chose Role</option>
                            <?php foreach ($hak_akses as $d):
                              if(!in_array($d->HakAksesID,array(1))):
                            ?>
                            <option value="<?php echo $d->HakAksesID;?>">
                                <?php echo $d->Name;?></option>
                            <?php endif; endforeach; ?>
                        </select>
                        <span class="help-block roleAlert"></span>
                    </div>
                </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="btn-group m-b-20 pull-right">
                <div class="btn-group open">
                    <button id="btnSave" type="button" class="btn btn-white dropdown-toggle  waves-effect" data-toggle="dropdown" aria-expanded="true"> Save <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" onclick="save('close')">Save & Close</a></li>
                        <li><a href="javascript:void(0)" onclick="save('new')">Save & Add New</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
              </div>
            </div>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
</div>
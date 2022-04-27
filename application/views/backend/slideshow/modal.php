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
               <form id="form" class="form-horizontal" role="form">
                <input type="hidden" name="SliderID">
                <input type="hidden" name="Type">
                <input type="hidden" name="Type2">
                <input type="file" name="photo2" class="dropify block"/>
               </form>
            </div>
            <div class="modal-footer">
              <div class="btn-group m-b-20 pull-right">
                <button id="btnSave" onclick="save_data()" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
              </div>
            </div>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
</div>

<!-- Modal -->
<div id="modal-crop" class="modal">
   <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
         <div class="panel panel-color panel-custom">
            <div class="panel-heading">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
               <h3 class="panel-title modal-title">Modal Title</h3>
            </div>
            <div class="panel-body table-responsive">
               <form id="form_crop" class="form-horizontal" role="form">
                <input type="hidden" name="SliderID">
                <div id="img-crop"></div>
               </form>
            </div>
            <div class="modal-footer">
              <div class="btn-group m-b-20 pull-right">
                <button id="btnSave" onclick="save_crop()" type="button" class="save btn btn-default">Save</button>
                <button onclick="delete_crop()" type="button" class="btn btn-default">Delete Crop</button>
                <label class="btn btn-default btn-file">
                    Select File <input type="file" id="fileimg" style="display: none;" accept="image/*">
                </label>
                <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
              </div>
            </div>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
</div>
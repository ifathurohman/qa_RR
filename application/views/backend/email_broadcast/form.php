<?php
	$urlFilter 	= $this->session->urlFilter;
	$member  	= $this->api->member();
?>
<!-- Modal -->
<div id="modal" class="modal modal-70 fade modal-fade-in-scale-up" data-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
         <div class="panel panel-color panel-custom">
            <div class="panel-heading">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
               <h3 class="panel-title modal-title">Modal Title</h3>
            </div>
            <div class="panel-body">
              <form id="form" autocomplete="off" enctype="multipart/form-data" method="post">
                <input type="hidden" name="EmailID">
                <input type="hidden" name="crud">
                <div class="row">
                  <div class="col-sm-12">
                     <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label">Subjek <span class="wajib"></span></label>
                        <input name="Subject" id="Subject" type="text" class="form-control" maxlength="100">
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Tanggal Kirim</label>
                        <input name="Date" id="Date" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>
                        <span class="help-block"></span>
                      </div>
                      <div class="col-sm-12"></div>
                      <div class="form-group col-sm-6 vmember">
                        <label class="control-label">Pilih Member <span class="wajib"></span></label>
                        <select name="member[]" id="member" data-email="active" data-select="active" data-subscribe="active" class="form-control select2 member_select" multiple="multiple">
                          <option value="all-member-0">Semua Member</option>
                          <option value="all-partner-0">Semua Partner</option>
                          <option value="all-client-0">Semua Client</option>
                          <option value="all-subscriber-0">Semua Subscriber</option>
                          <optgroup class="og_partner" label="Partner"></optgroup>
                          <optgroup class="og_client" label="Client"></optgroup>
                          <optgroup class="og_subscriber" label="Subscriber"></optgroup>
                        </select>
                        <span class="help-block"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Masukan Email Tidak Terdaftar <span class="wajib"></span></label>
                        <input type="text" name="other" class="form-control" data-role="tagsinput" />
                        <span class="help-block"></span>
                      </div>
                      <div class="col-sm-12">
                         <input id="add-attachment" type="file" multiple="" class="hidden" accept="application/pdf">
                         <div id="listb64" class="list-attachment row">
                           <div class="col-sm-12 div-add-attachment">
                               <label for="add-attachment" class="add-attachment">+ Pilih Lampiran</label>
                               <span class="help-block"></span>   
                               <p class="text-left">Catatan : Format file yang diperbolehkan (.pdf)</p>               
                           </div>
                         </div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label">Konten Email</label>
                        <textarea name="descrition" class="form-control summernote">
      
                        </textarea>
                        <span class="help-block"></span>
                      </div>
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
                        <li><a href="javascript:void(0)" onclick="save('new')">Save & New</a></li>
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

<link href="<?= base_url('aset/plugin/dropify/');?>dropify.min.css" rel="stylesheet">
<script src="<?= base_url('aset/plugin/dropify/');?>dropify.min.js"></script>
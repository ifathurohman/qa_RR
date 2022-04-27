<div id="modal" class="modal fade modal-fade-in-scale-up modal-75" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
          <div class="panel panel-color panel-custom">
              <div class="panel-heading"> 
                  <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title modal-title">Modal Title</h3>
              </div> 
              <div class="panel-body" style="padding: 0"> 
                <form id="form" autocomplete="off" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="ArticleID">
                  <input type="hidden" name="ArticleIDeng">
                  <div class="row" style="padding: 20px">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="form-group col-sm-12">
                          <label class="control-label">Header Image</label>
                          <input type="file" name="Image" id="input-file-now" class="dropify"/>
                          <span class="help-block"></span>
                          <span>File size max 1,8mb & format PNG, JPG, JPEG</span>
                        </div>
                          <ul class="nav nav-tabs" style="padding: 10px;">
                              <li class="active tab-indo" style="width: 50%;text-align: center;" onclick="language('indonesia')"><a data-toggle="tab" href="#home">Indonesia</a></li>
                              <li class="tab-eng" style="width: 50%;text-align: center;" onclick="language('english')"><a data-toggle="tab" href="#menu1">English</a></li>
                          </ul>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-outline btn-white" onclick="setting('setting')" type="button" style="float: right;margin-top: 10px;margin-bottom: 10px;"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        </div>
                        <div id="set">
                          <div class="form-group col-sm-12">
                            <label class="control-label">Code <span class="red">*</span></label>
                            <input name="Code" id="Code" type="text" class="form-control" disabled="">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 vindo">
                            <label class="control-label">Name <span class="red">*</span></label>
                            <input name="Name" id="Name" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 veng">
                            <label class="control-label">Name <span class="red">*</span></label>
                            <input name="Nameeng" id="Nameeng" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12">
                            <label class="control-label">Date <span class="red">*</span></label>
                            <input name="Date" id="Date" type="text" class="form-control date pointer" value="<?= date("d-m-Y"); ?>">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 vindo">
                            <label class="control-label">Summary <span class="red">*</span></label>
                            <input name="Summary" id="Summary" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 veng">
                            <label class="control-label">Summary <span class="red">*</span></label>
                            <input name="Summaryeng" id="Summaryeng" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 vindo">
                            <label class="control-label">Keywords <span class="red">*</span></label>
                            <input name="Keywords" id="Keywords" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12 veng">
                            <label class="control-label">Keywords <span class="red">*</span></label>
                            <input name="Keywordseng" id="Keywordseng" type="text" class="form-control">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group col-sm-12">
                            <label class="control-label">Category</label>
                            <select name="Category" placeholder="Category" id="Category" class="form-control"> 
                              <option value="article">Article</option>
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
                          <div class="form-group col-sm-12">
                            <label class="control-label">Status Publish</label>
                            <div class="radio-box">
                              <div class="radio-custom radio-primary">
                                <input type="radio" id="active" name="Active" checked="checked" value="1">
                                <label for="active">Publish</label>
                              </div>
                              <div class="radio-custom radio-primary">
                                <input type="radio" id="nonactive" name="Active" value="0">
                                <label for="nonactive">Unpublish</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="desc" class="col-sm-12">
                       <div class="row">
                        
                        <!-- <div class="form-group col-sm-12">
                          <label class="control-label">Summary</label>
                          <textarea name="Summary" id="Summary" type="text" class="form-control"></textarea>
                          <span class="help-block"></span>
                        </div> -->
                        <div class="form-group col-sm-12 vindo">
                          <label class="control-label">Content</label>
                          <textarea name="descrition" class="form-control summernote"></textarea>
                          <span class="help-block"></span>
                        </div>
                        <div class="form-group col-sm-12 veng">
                          <label class="control-label">Content</label>
                          <textarea name="descritioneng" class="form-control summernote"></textarea>
                          <span class="help-block"></span>
                        </div>
                        
                      </div>
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
<style type="text/css">
  .modal-dialog {
    width: 60%;
    margin: 30px auto;
  }
</style>
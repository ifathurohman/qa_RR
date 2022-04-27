<div class="div-form" style="display: none;">
  <div class="div-form-control">
      <button class="button editor-ground-control__back is-borderless" type="button" onclick="div_form('hide','')">Close</button>
      <div class="div-btn-action">
      <div class=" btn-group">
        <a type="button" class="btn btn-white show-sidebar" href="javascript:void(0)">Setting</a>
        <a  id="btnSave" type="button" class="btn btn-white" href="javascript:void(0)" onclick="save('close')">Save</a>
      </div>
    </div>
  </div>
  <div class="div-form-body"> 
    <form id="form" autocomplete="off" enctype="multipart/form-data" method="post" class="m-t-15">
      <div class="div-form-content">
        <input type="hidden" name="ProductID">           
        <input type="hidden" name="Type" value="<?= $modul; ?>">           
        <div class="row">
          <div class="col-sm-12">
            <input id="add-attachment" type='file' multiple="" class="hidden">
            <div id="listb64" class="list-attachment row">
              <div class="col-sm-12 add item">
                  <label for="add-attachment" class="add-attachment">+ Select Image</label>
                  <span class="help-block">up to 5 images here</span>                  
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <textarea name="Name" onchange="make_link(this)" onkeyup="make_link(this)" class="title-input" placeholder="Title" aria-label="Edit title" rows="1" style="overflow: hidden; overflow-wrap: break-word; height: 62px;"></textarea>
          </div>
          <?php if($modul == "page"): ?>
          <div class="col-sm-12 ">
            <span class="btn btn-sm btn-white mb-10" data-toggle="collapse" data-parent="#accordion" href="#div-link">show link</span>
            <div class="form-group collapse" id="div-link">
              <div class="input-group">
                  <span class="input-group-addon"><?= base_url(); ?></span>
                  <input type="text" name="Link" class="form-control" placeholder="link" onchange="make_link(this)" onkeyup="make_link(this)">
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="col-sm-12">
            <textarea name="Summary" class="mb-3r mt-1r text-input" placeholder="Summary" maxlength="130"></textarea>
          </div>
          <div class="col-sm-12">
            <textarea name="Description" class="form-control summernote" placeholder="Description"></textarea>
            <span class="help-block"></span>
          </div>
          
        </div>
      </div>
      <div class="div-form-sidebar side-bar right-bar">
        <div class="header">
          <span>Post Settings</span>
          <div class="pull-right">
            <a href="#" class="close"><i class="ti-close"></i></a>
          </div>
        </div>
        <ul class="ul-list">
          <li class="item">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#header-image">Hader Image</a>
            <div id="header-image" class="content collapse">
              <div class="main-img-preview">
                <img class="thumbnail img-preview" src="<?= base_url('aset/img/noicon.png'); ?>" title="Preview Logo" style="height: 150px;">
              </div>
              <div class="input-group">
                <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                <div class="input-group-btn">
                  <div class="fileUpload btn btn-danger fake-shadow">
                    <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                    <input type="file" name="Image" id="logo-id" class="attachment_upload">
                  </div>
                </div>
              </div>
              <p class="help-block">* Upload your logo.</p>
              <div class="form-group">
                <div class="radio radio-custom radio-primary">
                  <input type="radio" id="ImageShow" name="ImageStatus" checked="checked" value="1">
                  <label for="ImageShow">Show</label>
                </div>
                <div class="radio radio-custom radio-primary">
                  <input type="radio" id="ImageHide" name="ImageStatus" value="0">
                  <label for="ImageHide">Hide</label>
                </div>
              </div>
              <!-- <div class="form-group mt-1r">
                <label>Color Title</label>
                <input type="color" name="NameColor" class="form-control">
              </div> -->
            </div>
          </li>
          <li class="item">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#status-blog">Status <span id="label-active" class="label label-success pull-right">publish</span></a>
            <div id="status-blog" class="content collapse">
              <div class="radio radio-custom radio-primary">
                <input type="radio" id="active" name="Active" checked="checked" value="1">
                <label for="active">Publish</label>
              </div>
              <div class="radio radio-custom radio-primary">
                <input type="radio" id="nonactive" name="Active" value="0">
                <label for="nonactive">Unpublish</label>
              </div>
            </div>
          </li>
          <li class="item">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#template-category">Category</a>
            <div id="template-category" class="content collapse">
              <div class="form-group">
                <select name="CategoryID" class="form-control">
                  <?php foreach($this->main->Category("list") as $a): ?>
                  <option value="<?= $a->CategoryID; ?>"><?= $a->Name; ?></option> 
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group hide">
                <div class="radio radio-custom radio-primary">
                  <input type="radio" id="CategoryNormal" name="CategoryStatus" checked="checked" value="normal">
                  <label for="CategoryNormal">Normal</label>
                </div>
                <div class="radio radio-custom radio-primary">
                  <input type="radio" id="CategoryMain" name="CategoryStatus" value="main">
                  <label for="CategoryMain">Main</label>
                </div>
              </div>
            </div>
          </li>
          <li class="item">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#template-blog">Template</a>
            <div id="template-blog" class="content collapse">
              <div class="form-group">
                <select name="Template" class="form-control">
                  <option value="fullwidth">Fullwidth</option> 
                  <option value="normal">Normal</option>  
                  <option value="custom">Custom</option> 
                </select>
              </div>
            </div>
          </li>
        </ul>
    </form>
  </div>
</div>

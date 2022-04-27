<div class="page page-data" data-type="<?= $Type ?>" data-id="<?= $ID ?>" data-hakakses="<?= $this->session->hak_akses; ?>">
  <div class="page-header">
  </div>
  <div class="page-content">
    <div class="panel panel-bordered">
      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= $title; ?></h3>
      </header>
      <div class="panel-body" style="padding: 0px">
        <ul class="nav nav-tabs" style="background: #ced0d2">
            <li class="active" style="width: 50%;text-align: center;"><a data-toggle="tab" href="#home">Gallery</a></li>
            <li style="width: 50%;text-align: center;"><a data-toggle="tab" href="#menu1">Header Page</a></li>
        </ul>
        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div class="row" style="margin-bottom: 20px">
              <div class="col-sm-6">
                <form id="form_attachment" autocomplete="off">
                  <input type="hidden" name="ID" value="<?= $ID; ?>">
                  <input type="hidden" name="Type" value="<?= $Type; ?>">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <input type="file" name="photo[]" id="input-file-now" class="dropify" multiple="multiple" onchange="$('#form_attachment').submit();"/>
                    </div>
                  </div>
                </form>          
              </div>
              <div class="col-sm-6">
                <p><?= $format ?></p>
              </div>
            </div>
            <div class="row" id="attachment-list"></div>
          </div>
          <div id="menu1" class="tab-pane fade">
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-sm-6">
                <p>Pilih File foto terbaik untuk produk ini. (format .JPG .JPEG .PNG max 1,8 MB), good image resolution 1200px x 600px</p>
              </div>
            </div>
            <div class="row div-page-header list-data-header">

              <div class="col-sm-3" id="col-id-1">  
                <div class="title">Hot Project</div>
                <div class="div-image">
                  <a href="<?= site_url("hot-project"); ?>" target="_blank">
                    <img src="<?= site_url('/aset/img/default.png');?>" class="img-gallery-list">
                  </a>
                </div>
                <a href="javascript:void(0)" class="btn btn-default btn-block" onclick="edit(27)">Ubah Gambar</a>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('backend/slideshow/modal'); ?>

<link href="<?= base_url('aset/plugin/dropify/');?>dropify.min.css" rel="stylesheet">
<script src="<?= base_url('aset/plugin/dropify/');?>dropify.min.js"></script>

<link rel="stylesheet" href="<?= base_url("aset/plugin/toastr/toastr.min.css"); ?>">
<script src="<?= base_url("aset/plugin/toastr/toastr.min.js"); ?>"></script>

<script src="<?= base_url("aset/js/backend/slideshow.js"); ?>"></script>
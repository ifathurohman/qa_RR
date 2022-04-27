<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>">
   <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#">Master</a>
         </li>
         <li>
            <a href="#"><?= $title; ?></a>
         </li>
      </ol>
   </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="div-table">
      <div class="card-box table-responsive">
        <!-- <h4 class="m-t-0 header-title"><b>
        <?= $title; ?></b></h4> -->
        <div class="div-btn btn-group">
          <?= $tambah; ?>
          <button class="btn btn-outline btn-white" onclick="reload_table()" type="button">Reload</button>
        </div>
        <?php $this->load->view($modal); ?>
        <table id="table" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <!-- <th>Category</th> -->
              <th>Date</th>
              <th>Keywords</th>
              <th>Image</th>
              <th>Status</th>
              <th style="width:105px;">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
<?php $this->load->view($modal); ?>
<!-- Plugins For This Page -->
<style type="text/css">
  .dropify-wrapper {
    height: 350px;
  }
   .modal { overflow: auto !important; }
   .note-editor.note-frame .note-editing-area .note-editable {
    padding: 10px;
    padding-top: 50px !important;
    overflow: auto;
    color: #000;
    word-wrap: break-word;
    background-color: #fff;
}
</style>
<!-- Plugins For This Page -->
<script src="<?= base_url('aset/js/backend/article.js'); ?>"></script>
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

<link href="<?= base_url('aset/plugin/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?= base_url('aset/plugin/summernote/summernote.js'); ?>"></script>
<script type="text/javascript">
  $('.summernote').summernote({
      // height: 150,   //set editable area's height
      codemirror: { // codemirror options
        theme: 'monokai'
      }
    });
</script>


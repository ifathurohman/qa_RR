<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>">
   <div class="col-sm-12">
      <h4 class="page-title"><?= $title; ?></h4>
      <ol class="breadcrumb">
         <li>
            <a href="#"><?= $title; ?></a>
         </li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="div-table div-notification">
         <div class="panel panel-color panel-custom">
          <div class="panel-heading" style="line-height: 30px;">
            <div class="row">
              <div class="col-sm-3 col-xs-6">
                <span class="panel-title"><?= $title; ?></span>                
              </div>
              <div class="col-sm-9 col-xs-6">
                <div class="pull-right m-l-10">
                  <select class="form-control" onchange="load_x(this)">
                    <option value="all">Semua</option>
                    <option value="read">Sudah dibaca</option>
                    <option value="unread">Belum dibaca</option>
                  </select>
                </div>
                <div class="pull-right m-l-10">
                  <button onclick="notification_read('all')" class="btn btn-white btn-sm" type="button">Tandai Telah Dibaca</button>
                </div>
              </div>
            </div>
          </div>
          <ul class="list-group list-notification">
          </ul>
          <ul class="list-group list-notification-btn" style="display: none;">
            <li><a href="javascript:;" onclick="load_list_notification('load')" class="btn btn-block btn-default" type="button" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">Lihat Lebih Banyak</a></li>
          </ul>
        </div>
      </div>
   </div>
</div>
<script src="<?= base_url('aset/js/backend/notification.js'); ?>"></script>


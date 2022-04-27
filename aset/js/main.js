var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
// var host = window.location.origin + '/';
var host = window.location.origin + '/qa_RR/';
var url = window.location.href;
var current_url = window.location.href;
var url_diaspora = host + 'diaspora';
var url_search = host + 'search';
var url_contact = host + 'api/contact';
var page_detail = page_detail = host + "detail-attraction";
var width = $(window).width();
var width_awal = width;
var $body = $("body"),
  $html = $("html");
var pagenum_notif = 0;
var index_page;
var bahasa;
var start, length;
$(document).ready(function () {
  host = window.location.origin + '/';
  data_body = $("body").data();
  data_page = $(".data-page").data();
  length = 5;
  start = 0;
  init_plugin();
});
$(document).ready(function () {
  var current = location.pathname;
  $('.nav-menu a').each(function () {
    var $this = $(this);
    if ($this.attr('href') == current_url) {
      $this.addClass('active');
    }
  });
  $(".div-form-sidebar .close").click(function () {
    $(".div-form-sidebar").removeClass("active");
  });
  $(".div-form .show-sidebar").click(function () {
    if ($(".div-form-sidebar").hasClass("active")) {
      $(".div-form-sidebar").removeClass("active");
    } else {
      $(".div-form-sidebar").addClass("active");
    }
  });
  $(".div-form [name=Active]").change(function () {
    if ($(this).val() == 1) {
      if ($("#label-active").hasClass("label-danger")) {
        $("#label-active").removeClass("label-danger").addClass("label-success").text("publish");
      }
    } else {
      if ($("#label-active").hasClass("label-success")) {
        $("#label-active").removeClass("label-success").addClass("label-danger").text("upublish");
      }
    }
  });
});

function angka() {
  $(".angka").keyup(function () {
    angka = this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
  });
  $('#angka1').maskMoney();
  $('#angka2').maskMoney({
    prefix: 'US$'
  });
  $('.rupiah').maskMoney({
    prefix: 'Rp. ',
    thousands: '.',
    decimal: ',',
    precision: 0
  });
  $('.duit').maskMoney({
    thousands: ',',
    decimal: '.',
    precision: 0
  });
  $('.perKM').maskMoney({
    prefix: 'Rp. ',
    thousands: '.',
    decimal: ',',
    precision: 0,
    suffix: ' Per KM',
  });
  $('.perMnt').maskMoney({
    prefix: 'Rp. ',
    thousands: '.',
    decimal: ',',
    precision: 0,
    suffix: ' Per Menit',
  });
  $('.uang').maskMoney();
  $('.km').maskMoney({
    thousands: '.',
    decimal: ',',
    precision: 0,
    suffix: ' KM',
  });
  $('.persen').maskMoney({
    thousands: '',
    decimal: '.',
    precision: 2
  });
}

function init_plugin() {
  if ($("input,textarea").hasClass("summernote")) {
    summernote_init();
  }
  if ($("div,input").hasClass("attachment_upload")) {
    {
      img_preview();
    }
  }
  if ($("div").hasClass("note-editor")) {
    {
      remove_modal_overlay();
    }
  }
  if ($("input").hasClass("search_box")) {
    product_search();
  }
  if ($("select").hasClass("status_pekerjaan_select")) {
    status_pekerjaan_select();
  }
  if ($("select").hasClass("jenis_pekerjaan_select")) {
    jenis_pekerjaan_select();
  }
  if ($("select").hasClass("pegawai_select")) {
    pegawai_select();
  }
  if ($("select").hasClass("kendaraan_select")) {
    kendaraan_select();
  }
  if ($("select").hasClass("province_select")) {
    province_select();
  }
  if ($("select").hasClass("city_select")) {
    city_select(null, null);
  }
  if ($("select, datalist").hasClass("brand_select")) {
    brand_select();
  }
  if ($("select, datalist").hasClass("client_select")) {
    client_select();
  }
  if ($("select, datalist").hasClass("project_select")) {
    project_select();
  }
  if ($("table").hasClass("dataTable")) {
    $(".dataTables_processing").empty();
  }
  if ($("input, div").hasClass("date")) {
    datex();
  }
  if ($("div,span").hasClass("counter")) {
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
  }
  if ($("input").hasClass("dropify")) {
    $('.dropify').dropify();
  }
  if ($("input").hasClass("duit")) {
    angka();
  }
  if ($("select").hasClass("select2")) {
    $(".select2").select2();
  }
  if ($("a").hasClass('scrollToTop')) {
    $(".scrollToTop").click(function () {
      $("html, body").animate({
        scrollTop: 0
      }, "slow");
      return false;
    });
    jQuery(window).scroll(function () {
      if (jQuery(this).scrollTop() > 1000) {
        jQuery('.scrollToTop').fadeIn(500);
      } else {
        jQuery('.scrollToTop').fadeOut(500);
      }
    });
  }
  if ($("div, input, option").hasClass("selectpicker")) {
    $('.selectpicker').selectpicker();
  }
  if ($("div").hasClass("swiper-container")) {
    data_swiper = $(".swiper-container").data();
    swiper_page = data_swiper.page;
    swiper_slide = data_swiper.slide;
    console.log(swiper_page);
    if (swiper_slide > 0) {
      swiperslide = swiper_slide;
    } else {
      swiperslide = 5;
    }
    if (mobile) {
      swiperslide = 1;
    }
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: swiperslide,
      spaceBetween: 30,
      slidesPerGroup: swiperslide,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }
  if ($("span").hasClass("wajib")) {
    $(".wajib").html("(*)");
  }
}

function remove_modal_overlay() {
  $(".note-btn-group .btn").click(function () {
    $(".modal-backdrop").remove();
  });
}

function datex() {
  container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
  $(".date").datepicker({
    format: 'dd-mm-yyyy',
    container: container,
    todayHighlight: true,
    autoclose: true,
  });
}

function status_pekerjaan_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".status_pekerjaan_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/status_pekerjaan_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          data_tag = 'data-id = "' + v.ID + '" data-name="' + v.Name + '" data-urutan="' + v.Urutan + '"';
          item = '<option value="' + v.ID + '" ' + data_tag + '>' + v.Name + '</option>';
          $(".status_pekerjaan_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data branch, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function jenis_pekerjaan_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".jenis_pekerjaan_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/jenis_pekerjaan_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          data_tag = 'data-id = "' + v.ID + '" data-name="' + v.Name + '" data-urutan="' + v.Urutan + '"';
          item = '<option value="' + v.ID + '" ' + data_tag + '>' + v.Name + '</option>';
          $(".jenis_pekerjaan_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error jenis pekerjaan, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function pegawai_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".pegawai_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/pegawai_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '" data-skill="' + v.Skill + '">' + v.Name + '</option>';
          $(".pegawai_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data employe, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function province_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".province_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/province_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '" data-id="' + v.ID + '" data-name="' + v.Name + '">' + v.Name + '</option>';
          $(".province_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data province, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function province_city(element) {
  ID = $(element).find(':selected').val();
  data = $(element).find(':selected').data();
  if (ID > 0) {
    city_select(ID);
  }
}

function city_select(ProvinceID, CityID) {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".city_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/city_select/" + ProvinceID,
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          selected = '';
          if (v.ID == CityID) {
            selected = 'selected="selected';
          }
          item = '<option value="' + v.ID + '" data-id="' + v.ID + '" ' + selected + '>' + v.Name + '</option>';
          $(".city_select").append(item);
        });
        if (CityID) {
          $('.city_select').val(CityID).trigger('change');
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data province, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function kendaraan_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".kendaraan_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/kendaraan_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '">' + v.Name + '</option>';
          $(".kendaraan_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data car, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function brand_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".brand_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  console.log("brand_select");
  $.ajax({
    url: host + "api/brand_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '">' + v.Name + '</option>';
          $(".brand_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data brand, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function client_select() {
  select = "all";
  branch = "all";
  active = "";
  vs_data = $(".insurance_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
  }
  data_post = {
    select: select,
    active: active
  }
  $.ajax({
    url: host + "api/client_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '">' + v.Name + '</option>';
          $(".client_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data client, please try again');
      console.log(jqXHR.responseText);
    }
  });
}

function project_select() {
  select = "all";
  branch = "all";
  active = "";
  finish = "all";
  rencana = "none";
  vs_data = $(".project_select").data();
  if (vs_data) {
    select = vs_data.select;
    active = vs_data.active;
    rencana = vs_data.rencana;
  }
  data_post = {
    select: select,
    active: active,
    finish: finish,
    rencana: rencana,
  }
  $.ajax({
    url: host + "api/project_select/",
    type: "POST",
    dataType: "JSON",
    data: data_post,
    success: function (json) {
      if (json.Data.length > 0) {
        $.each(json.Data, function (i, v) {
          item = '<option value="' + v.ID + '">' + v.Name + '</option>';
          $(".project_select").append(item);
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('error get data project, please try again');
      console.log(jqXHR.responseText);
    }
  });
}
var modal_panel_status = 0

function modal_panel(element) {
  data_page = $(".data-page, .page-data").data();
  modul_page = data_page.modul;
  data_post = "";
  panel_data = $(element).data();
  modul_page = panel_data.modul_page;
  modul = panel_data.modul;
  classnya = panel_data.class;
  type = panel_data.type;
  page = panel_data.page;
  if (!type) {
    type = "none";
  } else if (type == "single") {
    type = 0;
  } else if (type == "group") {
    type = 1;
  }
  data_post = {
    page: "modal_panel",
    modul: modul,
    modul_page: modul_page,
    class: classnya,
    Type: type,
  }
  console.log(data_post);
  $("#table-panel").data("class", classnya);
  $('#modal-panel').modal('show');
  $('#modal-panel .modal-title').text('panel');
  url = 'api/modal_panel/';
  $('#table-panel').DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    order: [],
    "ajax": {
      url: url,
      type: "POST",
      data: data_post,
      dataSrc: function (json) {
        console.log(json);
        return json.data;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      }
    },
    columnDefs: [{
      targets: [],
      orderable: false,
    }, ],
  });
}

function chose_panel(element_chose) {
  data_page = $(".data-page, .page-data").data();
  modul_page = data_page.modul;
  chose_data = $(element_chose).data();
  classnya = chose_data.class;
  ID = chose_data.id;
  Code = chose_data.code;
  Name = chose_data.name;
  Type = chose_data.type;
  Point = chose_data.point;
  Modul = chose_data.modul;
  classnya = chose_data.class;
  $('#modal-panel').modal("hide");
  if (Type == 1) {
    console.log(classnya);
    $(".table-add tbody ." + classnya).remove();
    ambil_panel_detail(ID);
  } else {
    $(".panelid-" + classnya).val(ID);
    $(".panelname-" + classnya).val(Name);
    $(".panelpoint-" + classnya).val(Point);
  }
  if (modul_page == "Module") {
    hitung_point("modal");
  }
}

function ambil_panel_detail(ModuleID) {
  data_post = {
    Page: "panel_detail",
    ModuleID: ModuleID,
  }
  url = host + "api/panel/";
  $.ajax({
    url: url,
    type: "POST",
    data: data_post,
    dataType: "JSON",
    success: function (json) {
      console.log(json);
      $.each(json.Data, function (i, v) {
        tambah_panel("modal", v);
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
    }
  });
}

function modal_panel_detail(element) {
  de = $(element).data();
  panelid = de.class;
  ModuleID = de.moduleid;
  if (!ModuleID) {
    ModuleID = $("." + panelid).val();
  }
  if (ModuleID > 0) {
    $('#modal-panel-detail').modal("show");
    $('#modal-panel-detail .modal-title').text("Panel Detail");
    $('#modal-panel-detail #table-panel-detail tbody').empty();
    data_post = {
      page: 'modal_panel_detail',
      modul: 'modal',
      class: "none",
      ModuleID: ModuleID,
    }
    url = 'api/modal_panel/';
    $('#table-panel-detail').DataTable({
      destroy: true,
      processing: true,
      serverSide: true,
      order: [],
      "ajax": {
        url: url,
        type: "POST",
        data: data_post,
        dataSrc: function (json) {
          console.log(json);
          return json.data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR.responseText);
        }
      },
      columnDefs: [{
        targets: [],
        orderable: false,
      }, ],
    });
  }
}

function modal_pegawai(element) {
  data_page = $(".data-page, .page-data").data();
  modul_page = data_page.modul;
  data_post = "";
  panel_data = $(element).data();
  modul_page = panel_data.modul_page;
  modul = panel_data.modul;
  classnya = panel_data.class;
  type = panel_data.type;
  page = panel_data.page;
  data_post = {
    page: "modal_pegawai",
    modul: modul,
    modul_page: modul_page,
    class: classnya,
  }
  console.log(data_post);
  $("#table-pegawai").data("class", classnya);
  $('#modal-pegawai').modal('show');
  $('#modal-pegawai .modal-title').text('panel');
  $("#modal_pegawai .row-pilih").hide();
  $("#modal_pegawai .row-no").show();
  url = 'api/modal_pegawai/';
  $('#table-pegawai').DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    order: [],
    "ajax": {
      url: url,
      type: "POST",
      data: data_post,
      dataSrc: function (json) {
        console.log(json);
        return json.data;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      }
    },
    columnDefs: [{
      targets: [],
      orderable: false,
    }, ],
  });
}

function chose_pegawai(element_chose) {
  data_page = $(".data-page, .page-data").data();
  modul_page = data_page.modul;
  chose_data = $(element_chose).data();
  classnya = chose_data.class;
  ID = chose_data.id;
  Code = chose_data.code;
  Name = chose_data.name;
  Type = chose_data.type;
  Point = chose_data.point;
  Modul = chose_data.modul;
  classnya = chose_data.class;
  $('#modal-pegawai').modal("hide");
  $(".panelid-" + classnya).val(ID);
  $(".panelname-" + classnya).val(Name);
  $(".panelpoint-" + classnya).val(Point);
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

function tanya_agen() {
  $(".help-block").empty();
}

function kirim_pesan(page) {
  Kirim = false;
  $("#btn-kirim-pesan").addClass('loading').text("Submit...");
  $(".help-block").empty();
  $("#form-kirim-pesan input, #form-kirim-pesan textarea").each(function (i, v) {
    name = $(this)[0].name;
    value = $(this)[0].value;
    message = " cannot be null";
    if (value == "") {
      label = "";
      if (name == "Subject") {
        label = "Subjek";
      } else if (name == "Name") {
        label = "Name";
      } else if (name == "Company") {
        label = "Company";
      } else if (name == "Email") {
        label = "Email";
      } else if (name == "Contact") {
        label = "Contact";
      } else if (name == "Message") {
        label = "Message";
      }
      if (label != false) {
        $(this).next().addClass("error");
        next = $(this).next().text(label + message);
      }
      Kirim = false;
    } else if (name == "Email" && validateEmail(value) == "") {
      Kirim = false;
      $(this).next().addClass("error");
      next = $(this).next().text("Email tidak valid");
    } else {
      Kirim = true;
    }
  });
  if (Kirim == true) {
    var form = $('#form-kirim-pesan')[0];
    var formData = new FormData(form);
    $.ajax({
      url: url_contact,
      type: "POST",
      data: formData,
      dataType: "JSON",
      processData: false,
      contentType: false,
      success: function (data) {
        console.log(data);
        if (data.status) {
          swal("info", "Sending message success", '');
          $("#form-kirim-pesan input, #form-kirim-pesan textarea").val("");
        } else {
          swal("info", "Sending message failed", 'warning');
        }
        $("#btn-kirim-pesan").removeClass('loading').text("Submit");
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $("#btn-kirim-pesan").removeClass('loading').text("Submit");
        console.log(jqXHR.responseText);
        // swal('info', "Sending message failed", 'warning');
        $("#btn-kirim-pesan").button('reset');
      }
    });
  } else {
    $("#btn-kirim-pesan").removeClass('loading').text("Submit");
  }
}

function Formatmoney() {
  $('.duit').each(function () {
    $(this).maskMoney('mask', $(this).val());
  })
}

function remove_overlay() {
  $("body").removeClass("stop-scrolling");
}

function validateNumber(e) {
  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 39)) {
    return;
  }
  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    e.preventDefault();
  }
}

function scroll_notification() {
  $('.li-notification .notification-list').scroll(function () {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
      get_notification("load");
    }
  });
}
var TotalDataReal;

function get_notification(page) {
  if (page == "load") {
    start += 5;
  } else {
    start = 0;
    scroll_notification();
    $(".li-notification .notification-list").empty();
  }
  data_post = {
    length: length,
    start: start
  }
  console.log(data_post);
  url = host + "api/notification";
  $.ajax({
    url: url,
    type: "POST",
    data: data_post,
    dataType: "JSON",
    success: function (data) {
      if (data.HakAkses == "rc") {
        console.log(data);
      }
      if (data.TotalDataUnread > 0) {
        $(".notif-count").show().text(data.TotalDataUnread);
      }
      if (data.ListData.length > 0) {
        $.each(data.ListData, function (i, v) {
          add_item_notifx(v);
        });
      } else {
        if (page != "load") {
          add_item_notifx("none");
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
      console.log("gagal mengambil data notification");
    }
  });
}

function notification_read(method) {
  url = host + "api/notification_read/" + method;
  $.ajax({
    url: url,
    type: "POST",
    data: data_post,
    dataType: "JSON",
    success: function (data) {
      if (data.HakAkses == "rc") {
        console.log(data);
      }
      if (method == "all") {
        $(".list-notification .item").removeClass("unread");
        $(".notif-count").hide().text(0);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
      console.log("gagal menandai pesan sudah dibaca");
    }
  });
}

function add_item_notifx(v) {
  if (v == 'none') {
    item = '<a class="list-group-item"><center><h5 style="padding:50px 0px;">Tidak ada notifikasi untuk anda</h5></center></a>';
    $(".li-notification .notification-list").append(item);
  } else {
    read = '';
    labelread = '';
    if (v.Read == 0) {
      read = 'unread';
    }
    item = '<a href="' + v.Direct + '" class="list-group-item ' + read + '">';
    item += '<div class="media">';
    item += '<div class="pull-left p-r-10">';
    item += '<em class="fa fa-diamond noti-primary"></em>';
    item += '</div>';
    item += '<div class="media-body">';
    item += '<h5 class="media-heading">' + v.Title + " " + labelread + '</h5>';
    item += '<p class="m-0">';
    item += '<small>' + v.Message + '</small>';
    item += '<p class="m-0">';
    item += '<small class="tgl">' + v.Date + '</small>';
    item += '</p>';
    item += '</div>';
    item += '</div>';
    item += '</a>';
    $(".li-notification .notification-list").append(item);
  }
}

function removeUrlParams(sParam) {
  var url = window.location.href.split('?')[0] + '?';
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName, i;
  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');
    if (sParameterName[0] != sParam) {
      url = url + sParameterName[0] + '=' + sParameterName[1] + '&'
    }
  }
  return url.substring(0, url.length - 1);
}
var int_pass = 0

function show_pass() {
  if (int_pass == 0) {
    int_pass = 1;
    $('[name=Password]').attr('type', 'text');
    $('.show_password .fa').removeClass('fa-eye-slash');
    $('.show_password .fa').addClass('fa-eye');
  } else {
    int_pass = 0;
    $('[name=Password]').attr('type', 'password');
    $('.show_password .fa').removeClass('fa-eye');
    $('.show_password .fa').addClass('fa-eye-slash');
  }
}

function img_preview(page = "", img = "") {
  if (page == "reset") {
    $(".img-preview").attr('src', host + 'aset/img/noicon.png');
  } else if (page == "set") {
    $(".img-preview").attr('src', img);
  } else {
    $(".img-preview").attr('src', host + 'aset/img/noicon.png');
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function () {
      document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('.img-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#logo-id").change(function () {
      readURL(this);
    });
  }
}

function summernote_init() {
  $('.summernote').summernote({
    addclass: {
      debug: false,
      classTags: [{
        title: "Button",
        "value": "btn btn-success"
      }, "jumbotron", "lead", "img-rounded", "img-circle", "img-responsive", "btn", "btn btn-success", "btn btn-danger", "text-muted", "text-primary", "text-warning", "text-danger", "text-success", "table-bordered", "table-responsive", "alert", "alert alert-success", "alert alert-info", "alert alert-warning", "alert alert-danger", "visible-sm", "hidden-xs", "hidden-md", "hidden-lg", "hidden-print"]
    },
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video', 'hr']],
      ['view', ['codeview']]
    ],
    fontSize: 16,
    height: 500
  });
}
function readFile() {
  var files = this.files;
  var reader;
  var file;
  var i;
  for (i = 0; i < files.length; i++) {
    file = files[i];
    reader = new FileReader();
    reader.onload = (function(file) {
      return function(e) {
        add_attachment('add_new',e);
      };
    })(file);
    reader.readAsDataURL(file);
  }
}
function add_attachment(modul,e){
    HakDelete = 1;
    list_att = $(".list-attachment .item-attachment");
    if(modul == "add_new"){
        link = "javascript:;";
        b64 = e.target.result;
        id  = 0;
        if(list_att.length >= 10){
            toastr.error('Maximum file up to 10',"Information");
            return;
        }
        if(e && e.total > 2000000) {
            toastr.error('File size too big, size maximum is 2MB',"Information");
            return;
        }
        TypeFileb64 = b64.split(';')[0].split('/')[1];
    } else {
        link        = host + e.File;
        b64         = host + e.File;
        id          = e.AttachmentID;
        TypeFileb64 = e.FormatFile;
    }
    if(TypeFileb64 == 'pdf'){
        img_div = '<img src="'+host+'/aset/icon/pdf.png" height="100px" >';
    } else {
        img_div = '<img src="'+b64+'" height="100px" >';
    }
    if(TypeFileb64 == 'pdf' || 
       TypeFileb64 == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
       TypeFileb64 == 'vnd.ms-excel' || 
       TypeFileb64 == 'vnd.openxmlformats-officedocument.wordprocessingml.document' ||
       TypeFileb64 == 'msword' || 
       TypeFileb64 == 'plain' ||
       TypeFileb64 == 'png' || 
       TypeFileb64 == 'jpeg' ||
       TypeFileb64 == 'jpg' ||
       TypeFileb64 == 'txt' ||
       TypeFileb64 == 'xlsx' ||
       TypeFileb64 == 'xls' ||
       TypeFileb64 == 'docx' ||
       TypeFileb64 == 'doc'
    ){ } else {
        toastr.error('Format file not allowed, please use file format (png,jpg,pdf,doc,docx,xls,xlsx,txt)',"Information");
        return;
    }
    Name = '';
    no = 0;
    if(list_att.length > 0){
        $.each(list_att,function(i,v){
            if(i == 0){
                dt = $(v).data();
                no = dt.no;
            }
        });
    }
    no = no + 1;
    item_no = 'item-attachment-'+no;
    if(Name == ""){
        Name = 'untitled-'+no;
    }
    div_delete = "";
    if(HakDelete == 1){
        if(modul == "update" || modul == "add_new"){
            div_delete = '<div class="item-remove pointer" onclick="remove_attachment(this)" data-item="'+item_no+'" data-modul="'+modul+'" data-id="'+id+'"><i class="fa fa-trash"></i></div>';
        }
    }
    item = '<div class="col-sm-3 col-xs-4 text-center item item-attachment '+item_no+'" data-no="'+no+'">\
        <div class="item-body">\
        '+div_delete+'\
          <div class="div-img">\
          '+img_div+'\
          </div>\
        </div>'
    if(modul == "add_new"){
        item +='<input class="FileB64Attachment" type="hidden" name="FileB64[]" value="'+b64+'">';
        item +='<input class="FormatFileB64Attachment" type="hidden" name="FormatFileB64[]" value="'+TypeFileb64+'">';
    }
    if(modul != "add_new"){
        item += '<a href="'+link+'" class="title" title="'+Name+'" target="_blank">Lihat File</a>';
    }
    item +='</div>';
    $(".list-attachment").prepend(item);
}
function remove_attachment(element){
    dt = $(element).data();
    item = dt.item;
    modul = dt.modul;
    ProductImageID = dt.id;
    if(modul == "add_new"){
        $("."+item).remove();
    } else {    
        swal({   title: "Info",   
                 text: "Apakah anda yakin akan menghapus data ini ?",   
                 type: "warning",   
                 showCancelButton: true,   
                 confirmButtonColor: "#DD6B55",   
                 confirmButtonText: "Ya",   
                 cancelButtonText: "Tidak",   
                 closeOnConfirm: true,   
                 closeOnCancel: true }, 
                 function(isConfirm){   
                    if (isConfirm) { 
                        $.ajax({
                            url : host + 'api/remove_attachment/'+ProductImageID,
                            type: "POST",
                            dataType: "JSON",
                            success: function(json){
                                if(json.Status){
                                    dx = json.data;
                                    toastr.success(json.Message,"Information");
                                    $("."+item).remove();
                                } else {
                                    toastr.error(json.Message,"Information");
                                }
                                remove_overlay();
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                toastr.error("Terjadi kesalahan, gagal menghapus data","Information");
                                remove_overlay();
                                console.log(jqXHR.responseText);
                            }
                        });
                    }
        });
    }
}
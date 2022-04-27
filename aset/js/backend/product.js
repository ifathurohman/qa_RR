var mobile      = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
// var host        = window.location.origin+'/discovery/';
var host        = window.location.origin+"/";
var url         = window.location.href;
var url_list    = host + "product/ajax_list/";
var url_edit    = host + "product/edit/";
var url_hapus   = host + "product/delete/";
var url_simpan  = host + "product/save";
var url_update  = host + "product/update";
var url_coa_parent  = host + "api/coa_parent";
var save_method; //for save method string
var save_methodx;
var table;
var page_name;
var url_modul;
$(document).ready(function() {
    filter_table('pertama');
    $("#form-filter").keyup(function(e){
        if(e.keyCode == 13) {
            filter_table();
        }
    });
    $("input,textarea").change(function(){
        value = $("[name=Link]").val();
        if(value == ""){
            text = $("[name=Name]").val();
            text = text.replace(/[^A-Z0-9]/ig, "-").toLowerCase();
            $("[name=Link]").val(text);
        }
    });
    document.getElementById("add-attachment").addEventListener("change", readFile);


});
function make_link(elment){
    text = $(elment).val();
    text = text.replace(/[^A-Z0-9]/ig, "-").toLowerCase();
    $("[name=Link]").val(text);
}

function filter_table(page)
{
    if(page == "pertama"){
        url_string         = window.location.href
        url                = new URL(url_string);
        TransactionListID  = url.searchParams.get("id");
    } else {
        if(TransactionListID){
            url_real           = removeUrlParams("id");
            window.history.replaceState('Object', 'Title', url_real);
        }
        TransactionListID  = 0;
    }

    data_page       = $(".data-page, .page-data").data();
    page_name       = data_page.page_name;
    url_modul       = data_page.url_modul;
    modul           = data_page.modul;
    batas_panel     = data_page.batas_panel;
    MenuID          = data_page.menuid;
    url_list        = url_list;
    StartDate       = $("#form-filter [name=StartDate]").val();
    EndDate         = $("#form-filter [name=EndDate]").val();
    UserID          = $("#form-filter [name=UserID]").val();
    WorkStatusID    = $("#form-filter [name=WorkStatusID]").val();
    Status          = $("#form-filter [name=Status]").val();
    Search          = $("#form-filter [name=Search]").val();
    data_post   = {
        StartDate: StartDate,
        EndDate: EndDate,
        UserID: UserID,
        WorkStatusID: WorkStatusID,
        Status: Status,
        Search:Search,
        TransactionListID : TransactionListID,
        Modul : modul,
        MenuID : MenuID,
    }
    table = $('#table').DataTable({
      "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "searching": true,
        "order": [], //Initial no order.
        ajax: {
            url: url_list,
            type: "POST",
            data: data_post,
            error: function (jqXHR, textStatus, errorThrown) {
                // Do something here
                console.log(jqXHR.responseText);
            }
        },
        "columnDefs": [
        {
            "targets": [ -2,-1,0 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });
}
function add_data()
{
    save_method = 'add';
    $('#form')[0].reset();
    $(".disabled").attr("disabled",false);
    $('form div').removeClass('has-error');
    $('.help-block, .div-form .div-info').empty();
    $('.summernote').summernote('code', '');
    $(".div-form-control .btn").button("reset");
    if($("#label-active").hasClass("label-danger")){
      $("#label-active").removeClass("label-danger").addClass("label-success").text("publish");
    }
    $("form div").removeClass("in");
    img_preview("reset");
    $(".list-attachment .item-attachment").remove();
    div_form("open","insert");
}
function edit_data(id){
    save_method = 'update';
    $('#form')[0].reset();
    $('form div').removeClass('has-error');
    $('.help-block, .div-form .div-info').empty();
    $("form div").removeClass("in");
    img_preview("reset");
    $(".list-attachment .item-attachment").remove();
    $.ajax({
        url : url_edit+id,
        type: "POST",
        dataType: "JSON",
        success: function(data){
            if(data.HakAkses == 'rc'){
                console.log(data);
            }
            $("[name=ProductID]").val(data.ProductID);
            $("[name=CategoryID]").val(data.CategoryID);
            $("[name=Category]").val(data.Category);
            $("[name=Code]").val(data.Code);
            $("[name=Name]").val(data.Name);
            Link = data.Link;
            if(data.Link == ""){
                Link = data.Name.replace(/[^A-Z0-9]/ig, "-").toLowerCase();
            }
            $("[name=Link]").val(Link);
            $("[name=NameColor]").val(data.NameColor);
            $("[name=Summary]").val(data.Summary);
            $("[name=Template]").val(data.Template);
            $(".summernote").summernote("code", data.Description);
            if(data.Image){
                img_preview("set",data.Image);
            }

            if(data.Active == 1){
                $("form #active").prop("checked",true);
                if($("#label-active").hasClass("label-danger")){
                  $("#label-active").removeClass("label-danger").addClass("label-success").text("publish");
                }
            } else {
                $("form #nonactive").prop("checked",true);
                if($("#label-active").hasClass("label-success")){
                    $("#label-active").removeClass("label-success").addClass("label-danger").text("upublish");
                  }
            }
            if(data.CategoryStatus == 1){
                $("#CategoryNormal").prop("checked",true);
            } else {
                $("#CategoryMain").prop("checked",true);
            }
            if(data.ImageStatus == 1){
                $("#ImageShow").prop("checked",true);
            } else {
                $("#ImageHide").prop("checked",true);
            }

            $.each(data.ListImage,function(i,v){
                add_attachment('edit',v);
            })

            
            div_form("open","insert");
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal('Failed to get data');
            // swal('an error occurred failing to retrieve data');
        }
    });
}
function div_form(modul,crud)
{
    if(modul == "open"){
        $(".div-form").show(300);
        $('body').css('overflow', 'hidden'); 
    } else if(modul == "hide"){
        $(".div-form").hide(300);
         $('body').css('overflow', 'auto');  //ADD THIS
    }
}
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save(method)
{
    $("#btnSave").button("loading");

    var file = $('[name=Image]')[0].files[0];
    if(file && file.size > 2000000) { //2 MB (this size is in bytes)
        $('#btnSave').button("reset");
        toastr.error('Image size too big, size maximum is 2MB',"Information");
        return;
    }
    //-------------------------------------------------------------------------
    var url;
    if(save_method == 'add'){
        url = url_simpan;
    } else {
        url = url_update;
    }
    //summernote
    Description     = $('.summernote').summernote('code');
    var form        = $('#form')[0]; // You need to use standard javascript object here
    var formData    = new FormData(form);
    formData.append("Description", Description);
    $.ajax({
        url : url,
        type: "POST",
        // data: $('#form').serialize(),
        data:  formData,
        mimeType:"multipart/form-data", // upload
        contentType: false, // upload
        cache: false, // upload
        processData:false, //upload
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                // if(method == "close"){
                //     $('#modal').modal("hide");
                // } else if(method == "new"){
                //     save_method = "add";
                //     $('#form')[0].reset();
                //     $('form div').removeClass('has-error'); // clear error class
                //     $('.help-block').empty();
                //     $(".dropify-preview").hide();
                //     $(".dropify-render img").remove();
                //     $('.summernote').summernote('code', '');
                //     $(".modal").animate({ scrollTop: 0 }, "slow");
                // }
                toastr.success('Saving data is success',"Information");
                div_form("hide");
                reload_table();
            }
            else {
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty();
                for (var i = 0; i < data.inputerror.length; i++){
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    toastr.error(data.error_string[i],"Information");
                }
                if(data.message){
                    toastr.error(data.message,"Information");
                }

            }
            $('#btnSave').button("reset");
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR.responseText);
            toastr.error('Failed to saving data',"Information");
            // toastr.error('an error occurred failing to retrieve data',"Information");
            $('#btnSave').button("reset");
        }
    });
}

function delete_data(id)
{
    swal({   title: "Are you sure ?",   
             text: "You will not be able to recover this data !",   
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#DD6B55",   
             confirmButtonText: "Yes",   
             cancelButtonText: "No",   
             closeOnConfirm: true,   
             closeOnCancel: true }, 
             function(isConfirm){   
                if (isConfirm) { 
                    $.ajax({
                        url : url_hapus+id+"/nonactive",
                        type: "POST",
                        dataType: "JSON",
                        success: function(data){
                            if(data.status){
                                swal("Info", "Delete data is success", "");   
                                reload_table();
                            } else {
                                swal("Info", data.message, "");   
                            }
                            remove_overlay();
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            swal('Failed to delete data');
                            remove_overlay();
                        }
                    });
                }
    });
}
function active(id){
    $.ajax({
        url : url_hapus+id+"/active",
        type: "POST",
        dataType: "JSON",
        success: function(data){
            reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal('Error undeleting data');
        }
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
    list_att = $(".list-attachment .item-attachment");
    if(modul == "add_new"){
        b64 = e.target.result;
        id  = 0;
        if(list_att.length > 7){
            toastr.error('Maximum image up to 8',"Information");
            return;
        }
        if(e && e.total > 2000000) {
            toastr.error('Image size too big, size maximum is 2MB',"Information");
            return;
        }
    } else {
        b64 = e.ImageBase64;
        id  = e.ProductImageID;
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
    if(Name == ""){
        Name = 'untitled-'+no;
    }
    item_no = 'item-attachment-'+no;
    item = '<div class="col-sm-2 col-xs-4 item item-attachment '+item_no+'" data-no="'+no+'">\
      <a href="javascript:;" href="javascript:;">\
        <div class="item-body">\
          <div class="item-remove" onclick="remove_attachment(this)" data-item="'+item_no+'" data-modul="'+modul+'" data-id="'+id+'"><i class="fa fa-trash"></i></div>\
          <div class="div-img">\
           <img src="'+b64+'" height="100px" >\
          </div>\
        </div>'
    if(modul == "add_new"){
        item +='<input type="hidden" name="ImageB64[]" value="'+b64+'">';
    }
    item +='  </a>\
    </div>';
    $(".list-attachment").prepend(item);
        // <span class="title" title="'+Name+'">'+Name+'</span>\
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
                            url : host + 'product/remove_attachment/'+ProductImageID,
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
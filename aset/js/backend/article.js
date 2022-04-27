var mobile      = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
var host        = window.location.origin+'/';
var url         = window.location.href;
var url_list    = host + "article/ajax_list/";
var url_edit    = host + "article/edit/";
var url_hapus   = host + "article/delete/";
var url_simpan  = host + "article/save";
var url_share   = host + "share-brosure/";
var url_update  = host + "article/update";

var save_method; //for save method string
var table;
var page_name;
var url_modul;

$(document).ready(function() {
    data_page   = $(".data-page, .page-data").data();
    page_name   = data_page.page_name;
    url_modul   = data_page.url_modul;
    modul       = data_page.modul;
    if(modul == "company"){
        url_list = url_list_company+url_modul+"/"+modul;
    } else {
        url_list = url_list+url_modul+"/"+modul;
    }

    //datatables
    table = $('#table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url_list,
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });
});
function tambah()
{
    save_method = 'add';
    $("[name=Code]").attr("readonly",false);
    $(".parent_content_v").hide();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add New article'); // Set Title to Bootstrap modal title
    $('[name="crud"]').val("insert");

    //dropify
    $(".dropify-preview").hide();
    $(".dropify-render img").remove();
    //ajax
    $("#type_camera").prop("checked",true);
    $("[name=Type]").parent().removeClass('active');
    $("#type_camera").parent().addClass('active');
    $(".tab-pane").removeClass('active');
    $("#camera").addClass('active');
    // summernote
    $('.summernote').summernote('code', '');
    $("#member").prop("checked",true);
    $('[name=ArticleIDeng]').val('');
    $('[name=ArticleID]').val('');

    language("indonesia");
    setting();
    $('.category_select .data').hide();
    $('.category_select').val(0);
    
}
function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); // clear error string
    //dropify
    $(".dropify-preview").hide();
    $(".dropify-render img").remove();
    $('[name=ArticleID]').val('');
    $('[name=ArticleIDeng]').val('');
    language("indonesia");
    setting();
    //ajax
    $.ajax({
        url : url_edit + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            
            $("[name=ArticleID]").val(data.ArticleID);
            $("[name=Category]").val(data.Category);
            $("[name=Code]").val(data.Code);
            $("[name=Name]").val(data.Name);
            $("[name=Date]").val(data.Date);
            $("[name=Summary]").val(data.Summary);
            $("[name=Keywords]").val(data.Keywords);
            if(data.Active == 1){
                $("#active").prop("checked",true);
            } else {
                $("#nonactive").prop("checked",true);
            }
            $(".dropify-preview").show();
            img = '<img src="'+data.Image+'" />';
            $(".dropify-render").append(img);

            $("[name=descrition]").summernote("code", data.Description);

            $('.category_select .data').empty();
            if(data.CategoryID){
                item = '<option value="'+data.CategoryID+'">'+data.categoryName+'</option>';
                $('.category_select .data').append(item);
                $('.category_select').val(data.CategoryID);
                $('.category_select .data').show();
            }else{
                $('.category_select .data').hide();
            }

            // english
            $("[name=ArticleIDeng]").val(data.ArticleIDeng);
            $("[name=Nameeng]").val(data.Nameeng);
            $("[name=Summaryeng]").val(data.Summaryeng);
            $("[name=Keywordseng]").val(data.Keywordseng);
            $("[name=descritioneng]").summernote("code", data.Descriptioneng);

            Permission   = JSON.parse(data.Permission);
            $.each(Permission,function(i,v){
              $("#"+v).prop('checked', true);
            });
            $('#modal').modal("show");
            $('.modal-title').text('Edit Data');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add')
    {
        url = url_simpan;
    } 
    else
    {
        url = url_update;
    }
    //summernote
    Description = $('.summernote').summernote('code');
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
                swal('',data.message,'success');
                $('#modal').modal("hide");
                reload_table();
            }
            else
            {
                console.log(data);
                $(".modal").animate({ scrollTop: 0 }, "slow");
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty();
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); 
                    //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    // swal('',data.error_string[i],'warning');
                }

            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
            console.log(jqXHR.responseText);
            
        }
    });
}
function hapus(id)
{
    swal({   title: "Are you sure?",   
             // text: "You will not be able to recover this data !",   
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#DD6B55",   
             confirmButtonText: "Yes, delete it!",   
             cancelButtonText: "No, cancel it!",   
             closeOnConfirm: false,   
             closeOnCancel: false }, 
             function(isConfirm){   
                 if (isConfirm) { 
                    $.ajax({
                        url : url_hapus+id+"/nonactive",
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal('Error deleting data');
                        }
                    });
                    swal("Deleted!", "Your data has been deleted.", "success");   } 
                 else {
                     swal("Canceled", "Your data is safe :)", "error");   } 
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
function share(page, id){
  url_link = url_share+id;
  if(page == "whatsapp"){
    url = link_whatsapp('text='+url_link);
    window.open(url);
  }
  else if(page == "fb"){
    url = 'https://facebook.com/sharer/sharer.php?u='+url_link;
    window.open(url,"popupWindow", "width=600, height=400, scrollbars=yes");
  }
  else if(page == "email"){
    $('.vsendemail').show();
    $('.vMarketing, .vBrosur').hide();

    $('#form-email [name=BrosureID]').val(id);
    $('#sendTo').val(null).trigger("change");
    $('#form-email [name=other]').tagsinput('removeAll');

    $("#view-print").empty();
    $(".div-loader").show();
    $('.modal-title').text("Kirim Email");
    $('#modal2').modal('show');
    $(".div-loader").hide();
  }
}

function language(val){
    $('.tab-indo, .tab-eng').removeClass("active");
    if(val == "indonesia"){
        $('.vindo').show(300);
        $('.veng').hide(300);
        $('.tab-indo').addClass("active");
    }else{
        $('.vindo').hide(300);
        $('.veng').show(300);
        $('.tab-eng').addClass("active");
    }
}

function setting() {
  var y = document.getElementById("set");
  var x = document.getElementById("desc");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
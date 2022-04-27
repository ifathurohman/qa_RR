var mobile      = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
var host        = window.location.origin+'/';
var url         = window.location.href;
var url_list    = host + "member/ajax_list/";
var url_edit    = host + "member/edit/";
var url_hapus   = host + "member/delete/";
var url_active  = host + "member/active/";
var url_simpan  = host + "member/save";
var url_update  = host + "member/update";

var save_method; //for save method string
var table;
var page_name;
var url_modul;

$(document).ready(function() {
     $("[name=Member_type]").change(function(){
        val = $(this).val();
        check_type(val);
    });
    
    filter_table();
});

function filter_table(page){
    data_page   = $(".data-page, .page-data").data();
    page_name   = data_page.page_name;
    url_modul   = data_page.url_modul;
    modul       = data_page.modul;
    hakakses    = data_page.hakakses;

    Search      = $("#form-filter [name=Search]").val();
    fType       = $("#form-filter [name=fType]").val();
    fStatus     = $("#form-filter [name=fStatus]").val();

    data_post   = {
        Search    : Search,
        Type      : fType,
        Status    : fStatus,
    }

    url    = url_list+url_modul+"/"+modul;
    table = $('#table').DataTable({
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "searching": false,
        "language": {                
            "infoFiltered": ""
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url"   : url,
            "type"  : "POST",
            "data"  : data_post,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });
}

function check_type(val){
    if (val == 2) {
        $(".vparent_category").show(300);
        // Position = $(this).val();
    } else{
         $(".vparent_category").hide(300);
    }
}

function tambah()
{
    save_method = 'add';
    $(".dropify-preview").hide();
    $(".dropify-render img").remove();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add New member'); // Set Title to Bootstrap modal title
    $('[name="crud"]').val("insert");
    check_type(0);

    $('.category_select .data').hide();
    $('.category_select').val(0);
}
function edit(id)
{
    save_method = 'update';
    $(".dropify-preview").hide();
    $(".dropify-render img").remove();
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    //---------------------------------------------
    if(modul == "company"){
       save_method = "view";
       modal_title = "View Detail";
       $("#btnSave").hide(); 
       $("#form input, #form textarea").attr("disabled",true);
    } else {
        modal_title = 'Edit Data ' + page_name;
    }
    $.ajax({
        url : url_edit + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.hakakses == "developer"){
                console.log(data);
            }
            v = data.data;
            $('[name="MemberID"]').val(v.MemberID);
            $('[name="Name"]').val(v.Name);
            $('[name="Email"]').val(v.Email);
            $('[name="Category"]').val(v.Category);
            $('[name="Member_type"]').val(v.Member_type);
            $('[name="Remark"]').val(v.Remark);
            $('[name=LinkWebsite]').val(v.LinkWebsite);
            $('[name=Subscribe]').val(v.Subscribe);

            $(".dropify-preview").show();
            img = '<img src="'+v.Image+'" />';
            $(".dropify-render").append(img);

            $('.category_select .data').empty();
            if(v.CategoryID){
                item = '<option value="'+v.CategoryID+'">'+v.categoryName+'</option>';
                $('.category_select .data').append(item);
                $('.category_select').val(v.CategoryID);
                $('.category_select .data').show();
            }else{
                $('.category_select .data').hide();
            }

            check_type(v.Member_type);

            $('#modal').modal("show");
            $('.modal-title').text(modal_title);
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
    if(save_method == 'add') {
        url = url_simpan;
    } else if(save_method == "update"){
        url = url_update;
    }
    var form        = $('#form')[0]; // You need to use standard javascript object here
    var formData    = new FormData(form);
    $.ajax({
        url : url,
        type: "POST",
        data:  formData,
        mimeType:"multipart/form-data", // upload
        contentType: false, // upload
        cache: false, // upload
        processData:false, //upload
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal').modal("hide");
                reload_table();
            }
            else
            {
                if(data.message){
                    swal({ html:true,type: "warning", title:'', text:data.message,});
                }

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
// function hapus(id)
// {
//     swal({   title: "Are you sure?",   
//              // text: "You will not be able to recover this data !",   
//              type: "warning",   
//              showCancelButton: true,   
//              confirmButtonColor: "#DD6B55",   
//              confirmButtonText: "Yes, delete it!",   
//              cancelButtonText: "No, cancel it!",   
//              closeOnConfirm: false,   
//              closeOnCancel: false }, 
//              function(isConfirm){   
//                  if (isConfirm) { 
//                     $.ajax({
//                         url : url_hapus+id+"/nonactive",
//                         type: "POST",
//                         dataType: "JSON",
//                         success: function(data)
//                         {
//                             //if success reload ajax table
//                             reload_table();
//                         },
//                         error: function (jqXHR, textStatus, errorThrown)
//                         {
//                             swal('Error deleting data');
//                         }
//                     });
//                     swal("Deleted!", "Your data has been deleted.", "success");   } 
//                  else {
//                      swal("Canceled", "Your data is safe :)", "error");   } 
//     });
// }
function active_data(id,status){

    if(status == "active"){
        pesan = "Apa anda yakin akan mengaktifkan data ini ?";
        pesan_success = "data berhasil diaktifkan";
    } else {
        pesan = "Apa anda yakin akan menonaktifkan data ini ?";
        pesan_success = "data berhasil dinonaktifkan";
    }
    swal({   
            // type:"input",
            title: "Info",   
            text: pesan,   
            // type: "warning",   
            showCancelButton: true,   
            // confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Ya",   
            cancelButtonText: "Tidak",   
            closeOnConfirm: true,   
            closeOnCancel: true }, 
            function(isConfirm){   
                if (isConfirm) { 
                    $.ajax({
                        url : url_active+id+"/"+status,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data){
                            // swal("", pesan_success, "success");   
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            swal('gagal melakukan ubah data');
                        }
                    });
                }
    });

}
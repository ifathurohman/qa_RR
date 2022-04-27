var mobile      = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
// var host        = window.location.origin+'/discovery/';
var host        = window.location.origin+"/";
var url         = window.location.href;
var url_list    = host + "Email_broadcast/ajax_list/";
var url_edit    = host + "Email_broadcast/edit/";
var url_hapus   = host + "Email_broadcast/delete/";
var url_active  = host + "Email_broadcast/active/";
var url_simpan  = host + "Email_broadcast/save";
var url_update  = host + "Email_broadcast/update";
var url_cetak   = host + "Email_broadcast/cetak";
var url_send    = host + "Email_broadcast/sendTo/";

var save_method; //for save method string
var table;
var page_name;
var url_modul;
var hakakses2;

var id_kontak;

$(document).ready(function() {
    
    filter_table('first');    

    checkadd();
    document.getElementById("add-attachment").addEventListener("change", readFile);  
});

function filter_table(page){
    data_page   = $(".data-page, .page-data").data();
    page_name   = data_page.page_name;
    url_modul   = data_page.url_modul;
    modul       = data_page.modul;
    hakakses2   = data_page.hakakses2;
    
    url = url_list+url_modul;

    if(page == "first"){
        $('#form-filter [name=fStartDate]').val('');
    }

    StartDate = $('#form-filter [name=fStartDate]').val();
    EndDate   = $('#form-filter [name=fEndDate]').val();
    Type      = $('#form-filter [name=fType]').val();
    Search    = $('#form-filter [name=Search]').val();

    data_post   = {
        StartDate : StartDate,
        EndDate   : EndDate,
        Type      : Type,
        Search    : Search,
    } 
    console.log(data_post)
    //datatables
    table = $('#table').DataTable({
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "searching": false,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url,
            "type": "POST",
            data: data_post,
        },
        "language": {                
          "infoFiltered": ""
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

function checkadd(){
    if(hakakses2 == "marketing"){
        $('#agent').show();
    }else{
        $('#agent').show();
    }
}

function add_new()
{
    save_method = 'add';
    $(".v_parent").hide();
    resetForm();



    $('#form')[0].reset(); // reset form on modals
    $('form div').removeClass('has-error'); // clear error class
    $(".list-attachment .item-attachment").remove();
    $('.error-select').removeClass('error-select');
    $('.help-block').empty(); // clear error string
    $('#modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
    $('[name="crud"]').val("insert");
    $('[name=other]').tagsinput('removeAll');
}
function save(method)
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    $('.error-select').removeClass('error-select');
    var url;
    if(save_method == 'add'){
        url = url_simpan;
    } else {
        url = url_simpan;
    }
    //summernote
    var form        = $('#form')[0]; // You need to use standard javascript object here
    var formData    = new FormData(form);
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
            console.log(data);
            if(data.status) //if success close modal and reload ajax table
            {   
                swal('Berhasil menyimpan data');
                if(method == "close"){
                    $('#modal').modal("hide");
                } else if(method == "new"){
                    add_new();
                }
                reload_table();
                $(".FileB64Attachment, .FormatFileB64Attachment").remove();
            }
            else
            {
              $(".modal").animate({ scrollTop: 0 }, "slow");
              $('.form-group').removeClass('has-error'); // clear error class
              $('.help-block').empty();
              $('.error-select').removeClass('error-select');
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    name            = data.inputerror[i];
                    type            = data.type[i];
                    error_string    = data.error_string[i];
                    if(type == "select"){
                        $('[name="'+data.inputerror[i]+'"]').eq(0).next().addClass('error-select');
                        $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                        $('.vmember .help-block').text('data tidak boleh kosong');
                    }
                    else{
                        label = $('[name="'+data.inputerror[i]+'"]').parent().find("label").text();
                        if(error_string == ""){
                            error_label = label+" tidak boleh kosong";
                        }else{
                            error_label = error_string;
                        }
                        if(name != "other"){
                            $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                        }else{
                            $('.vnotregistered').addClass('has-error')
                        }
                        $('[name="'+data.inputerror[i]+'"]').next().text(error_label);
                    }
                }

            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR.responseText);
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}

function resetForm(){
    $('#member').select2().select2('val', ['']);
    $(".summernote").summernote("code", '');
}

$('#to').change(function(){
    val = $(this).val();
    checkTo(val);
})
function checkTo(val){
    // 1 = Agent
    // 2 = pemilik
    // 3 = Pembeli

    if (val == "none") {
        $('.vsendTo, .vPembeli, .vPemilik, .vUser, .vnotregistered').hide(300);
    }
    else if(val == 1){
        $('.vsendTo').show(300);
        $('.vPembeli, .vPemilik, .vUser, .vnotregistered').hide(300);
    }else if(val == 2){
        $('.vPemilik').show(300);
        $('.vPembeli, .vsendTo, .vUser, .vnotregistered').hide(300);
    }else if(val == 3){
        $('.vPembeli').show(300);
        $('.vsendTo, .vPemilik, .vUser, .vnotregistered').hide(300);
    }else if(val == 4){
        $('.vUser').show(300);
        $('.vsendTo, .vPemilik, .vPembeli, .vnotregistered').hide(300);
    }else if(val == 5){
        $('.vnotregistered').show(300);
        $('.vsendTo, .vPemilik, .vPembeli, .vUser').hide(300);
    }
}

function view_print(id,method,status){
    $("#view-print").empty();
    $(".div-loader").show();

    url     = url_cetak+"/"+id;
    urlku   = url;
    if(method == "view"){
        urlku = urlku+"?method=view";
        $('#link_send').hide();
    }else if(method == "view_status"){
        urlku = urlku+"?method=view_status";
        $('#link_send').show();
    }
    else{
        urlku = urlku+"?method=";
        $('#modal-update').show();
    }

    if(status == 1){
        $('.btn-send').hide();
    }else{
        $('.btn-send').show();
    }
   
    $('#modal2').modal('show');
    $('.modal-title').text("lihat");
    $("#view-print").load(urlku,function(){
        $(".div-loader").hide();
    });
    $("#link_print").attr("href",urlku+"&cetak=cetak");
    $("#link_pdf_1").attr("href",urlku+"&cetak=pdf&position=portrait");
    $("#link_pdf_2").attr("href",urlku+"&cetak=pdf&position=landscape");
    $('#link_send').attr("onclick", 'sendTo('+id+')');
}

function sendTo(id){
    $('#link_send').text('Loading...'); //change button text
    $('#link_send').attr('disabled',true); //set button disable
    $.ajax({
        url :url_send+id,
        type:"POST",
        dataType:"JSON",
        data:data_post,
        success: function(data)
        {
            if(data.hakakses == "developer"){
                console.log(data)
            }
            if(data.status){
                swal(data.message);
                reload_table();
                $('#modal2').modal('hide');
            }else{
                swal(data.message, '', 'warning');
                reload_table();
                $('#modal2').modal('hide');
                // view_print(id,'view_status')
            }
            $('#link_send').text('Kirim'); //change button text
            $('#link_send').attr('disabled',false); //set button enable
            
        },
            error: function (jqXHR, textStatus, errorThrown)
        {
            $('#link_send').text('Kirim'); //change button text
            $('#link_send').attr('disabled',false); //set button enable
        }
    });
}
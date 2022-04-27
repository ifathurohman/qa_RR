// kalau pusing tanya yang bikinya
var host        = window.location.origin+'/';
var attc;
var TypePage;
var IDPage;
var crop;

$(document).ready(function(){    
    data_page = $(".page-data").data();
    TypePage  = data_page.type;
    IDPage    = data_page.id;
    get_what_expect();
    get_header();
    // Basic
    $('.file-icon').attr("src","");
    $('.file-icon').html("<h4>Add File</h4>");
    var drEvent = $('#input-file-events').dropify();
    drEvent.on('dropify.beforeClear', function(event, element){
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });
    drEvent.on('dropify.afterClear', function(event, element){
        alert('File deleted');
    });
    drEvent.on('dropify.errors', function(event, element){
        console.log('Has Errors');
    });
    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e){
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    });   
});

function get_what_expect()
{
  $("#attachment-list").empty();
  $.ajax({
    url : host+"Slideshow/list/"+TypePage+"/"+IDPage,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    	// console.log(data);
     	$.each(data, function (key,value) {
    	 	setImage(value);   
      	});
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        // alert('Error get data from ajax');
    }
  });
}

$("#form_attachment").submit(function( event ) {
  event.preventDefault();
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty();
  $("#save").text("Saving...");
  $("#save").attr("disable",true);
  $.ajax({
    url: host+"Slideshow/save",
    type: "POST",
    data:  new FormData(this),
    mimeType:"multipart/form-data",
    contentType: false,
    cache: false,
    processData:false,
    dataType: "JSON",
    success: function(data_res)
    {
        // console.log(data_res);
        $.each(data_res,function(i,data){
          if(data.status) //if success close modal and reload ajax table
          {
            $("[name=caption]").val("");
          	$("#save").text("Save");
          	$("#save").attr("disable",false);
          	toastr.success("Saving data success","Information");
          	clear_img();
          	setImage(data);
          } 
          else {
              if(data.message){
                  swal({ html:true,type: "warning", title:'', text:data.message,});
              }
          }
        });
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      console.log(jqXHR.responseText);
      $("[name=caption]").val("");
      $("#save").text("Save");
      $("#save").attr("disable",false);
      clear_img();
      toastr.error("Error saving data, Size image too large or image format does not match","Information");
    }
  });
});

function clear_img(){
  var drEvent = $('.dropify').dropify();
  drEvent = drEvent.data('dropify');
  drEvent.resetPreview();
  drEvent.clearElement();
}

function setImage(data)
{
	SliderID = data.SliderID;
	ID 			 = data.ID;
	cek 		 = data.cek;
  Active   = data.Active;
	url 		 = data.url_photo;
	url_file 	 = data.url_file;
	caption 	 = data.caption;

    status  = "basic";
    checked = "";
    title   = 'Inactive Image';
    icon    = '<i class="fa fa-close" aria-hidden="true"></i>';
    if(Active != 1){
      icon    = '<i class="fa fa-check" aria-hidden="true"></i>';
      title   = 'Active Image';
    }

  	img = '<div class="col-sm-3" id="row-'+SliderID+'">';
  	img +='  <div class="div-image">';
  	// img +='<a href="javascript:void(0)" class="img-view" data-toggle="tooltip" data-placement="top" title="Edit data" target="_blank" onclick="edit('+SliderID+')">';
  	// img +='<i class="fa fa-pencil" aria-hidden="true"></i>';
  	// img +='</a>';

  	// type = $('[name=Type]').val();
  	// if(type == 6 || type == 5){
    img += '<input type="radio" id="cek'+SliderID+'" name="cek" value="ada" '+checked+' class="input-hidden" onclick="active_file('+SliderID+','+"'"+Active+"'"+')"/>';
    img += '<label for="cek'+SliderID+'" class="img-primary" data-toggle="tooltip" data-placement="top" title="'+title+'">';
    img += icon;
    img += '</label>';
  	// }

  	img += '<a href="javascript:void(0)" class="img-edit" data-toggle="tooltip" data-placement="top" title="Crop Image for device" \
    onclick="crop_file('+"'"+SliderID+"','"+url_file+"'"+')" data-status="'+status+'">';
  	img += '<i class="fa fa-crop" aria-hidden="true"></i>';
  	img += '</a>';

    img += '<a href="javascript:void(0)" class="img-remove" data-toggle="tooltip" data-placement="top" title="Delete Image" onclick="remove_file('+SliderID+',this)" data-status="'+status+'">';
    img += '<i class="fa fa-trash" aria-hidden="true"></i>';
    img += '</a>';
  
  	img += '<a href="'+url_file+'" target="_blank">';
  	img += '<img src="'+url+'" class="img-gallery-list">';
  	img += '<div class="form-group">';
  	// img +='<input type="text" name="photo" class="form-control" id="input-'+SliderID+'" placeholder="Photo caption" value="'+caption+'" onchange="update_file('+SliderID+')"/>';
  	img +='</div>';  
  	img += '</a>';

  	img +='</div>';
  	img +='</div>';
  	$("#attachment-list").prepend(img);
  	$('[data-toggle="tooltip"]').tooltip(); 
}

function active_file(SliderID,Active){
  attc    = $("#data").data("attc");
  caption = $("#input-" + SliderID).val();
  cek     = "tidak";
  if($("#cek"+SliderID).is(':checked')) {
    cek   = $("#cek"+SliderID).val(); 
  }

  data_post = {
      Type 			: TypePage,
      SliderID 	: SliderID,
      Active 		: Active,
      caption 	: caption,
      attc 			: attc,
      cek 			: cek,
    };
  $.ajax({
    url : host+"Slideshow/active/",
    type: "POST",
    data : data_post,
    dataType: "JSON",
    success: function(data)
    {
        toastr.success("Update data success","Information");
        get_what_expect();
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        toastr.error("Failed update data","Information");
    }
  });
}

function remove_file(id,element){
  	status = $(element).data("status");

  	type = $('[name=Type]').val();
  	if(type == 6 || type == 5){

  	}else{
    	status = "bukan_main";
  	}

  	if(status == "main"){
    	toastr.error("Sorry this image cannot be delete","Information");
  	} else {
  		swal({   
        	title: "Are you sure ?",   
        	type: "warning",   
        	showCancelButton: true,   
        	confirmButtonColor: "#DD6B55",   
        	confirmButtonText: "Delete",   
        	cancelButtonText: "Cancel",   
        	closeOnConfirm: true,
        	closeOnCancel: false }, 
        	function(isConfirm){   
            	if (isConfirm) { 
            		$.ajax({
			      		url : host+"Slideshow/delete/"+id,
			      		type: "POST",
			      		dataType: "JSON",
			      		success: function(data)
			      		{
				         	$("#row-"+id).remove();
				          	// toastr.success("Deleteting data success","Information");
                    toastr["success"]("Deleteting data success","Information");
			      		},
			      		error: function (jqXHR, textStatus, errorThrown)
			      		{
				          	toastr.error("Failed deleting data","Information");
				          	get_what_expect();
			      		}
				    });
            	} 
            	else {
                	swal("Canceled", "", "error");   
            	} 
    	});
  	}

}

function get_header(){
  $.ajax({
    url : host+"Slideshow/header_list/",
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
      $('.list-data-header').empty();
      $.each(data, function (key,value) {
        set_header(value);
      });
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      
    }
  });
}

function set_header(data){
  SliderID = data.SliderID;
  cek      = data.cek;
  Active   = data.Active;
  Type2    = data.Type2;
  url      = data.url_photo;
  url_file   = data.url_file;
  caption    = data.caption;

  item = '<div class="col-sm-3" id="col-id-'+SliderID+'"> \
            <div class="title">'+Type2.toUpperCase()+'</div>\
            <div class="div-image">\
              <a href="'+host+Type2+'" target="_blank">\
                <img src="'+url+'" class="img-gallery-list">\
              </a>\
            </div>\
            <a href="javascript:void(0)" class="btn btn-default btn-block" onclick="edit('+SliderID+')">Ubah Gambar</a>\
            <a href="javascript:void(0)" class="btn btn-default btn-block" onclick="crop_file('+"'"+SliderID+"','"+url_file+"'"+')">Potong Gambar</a>\
          </div>';
  $('.list-data-header').append(item);
}

function edit(id,element)
{
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); // clear error string
    $('.modal-title').text('Ubah Gambar');
    $("#form .dropify-preview").hide();
    $("#form .dropify-render img").remove();
    if(id == 0){
      save_method = 'add';
      $('#modal').modal("show");  
    } else {
      save_method = 'update';
    }
    if(element){
      de = $(element).data();
      // $("#form .dropify-preview").show();
      // img = '<img src="'+de.image+'" />';
      // $("#form .dropify-render").append(img);

      $("#form [name=SliderID]").val(de.id);
      $("#form [name=Type]").val(de.type);
      $("#form [name=Type2]").val(de.type2);
    }
    if(save_method == "update"){
      $.ajax({
          url : host+"Slideshow/ajax_edit/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            v = data.data;
            console.log(data);
            $("#form [name=SliderID]").val(v.SliderID);
            $("#form [name=Type]").val(v.Type);
            $("#form [name=Type2]").val(v.Type2);

            $("#form .dropify-preview").hide();
            $("#form .dropify-render img").remove();

            // $("#form .dropify-preview").show();
            // img = '<img src="'+data.Image+'" />';
            // $("#form .dropify-render").append(img);
            $('#modal').modal("show");  
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

}

function save_data()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add')
    {
       url = host+"Slideshow/ajax_update";
    } 
    else
    {
        url = host+"Slideshow/ajax_update";
    }
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
            if(data.status){
              get_header();
              $('#modal').modal("hide");
            } else {
              alert("please upload your image");

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

function crop_file(id,url_file){
  $('#modal-crop').modal('show');
  $('#modal-crop .modal-title').text('Crop Image');
  $('#modal-crop [name=SliderID]').val(id);

  item = '<img class="full-width my-image"/>';
  $('#img-crop').empty();
  $('#img-crop').append(item);

  $('#modal-crop .my-image').attr('src', url_file);

  height = $('#modal-crop .my-image').height();
  crop = $('#modal-crop .my-image').croppie({
    viewport: {
        width: 550,
        height:550,
    },
    type: "canvas",
    format: "png",
    enforceBoundary: false,
    enableExif: true
  });
  $('.cr-boundary').height(550);
}

function save_crop(){
  crop.croppie('result', 'canvas').then(function(html) {
    img_result = html;

    url = host+"Slideshow/save_crop/";
    id = $('#form_crop [name=SliderID]').val();
    data_post = {
      img   : img_result,
      id    : id,
    }
    $('#btnSave, .save').text('saving...'); //change button text
    $('#btnSave, .save').attr('disabled',true); //set button disable
    $.ajax({
        url     : url,
        type    : "POST",
        data    : data_post,
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            if(data.status){
              $('#modal-crop').modal("hide");
              swal('',data.message, 'success');
            }else{
              swal('','gagal crop data', 'warning');
            }
            $('#btnSave, .save').text('save'); //change button text
            $('#btnSave, .save').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave, .save').text('save'); //change button text
            $('#btnSave, .save').attr('disabled',false); //set button enable
            console.log(jqXHR.responseText);
        }
    });
  });
}

$('#fileimg').on('change', function(){
  readURL(this);
});
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      id  = $('#form_crop [name=SliderID]').val();
      img = e.target.result;
      crop_file(id,img);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function delete_crop(){
  id = $('#form_crop [name=SliderID]').val();
  swal({   
        title: "Are you sure ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Delete",   
        cancelButtonText: "Cancel",   
        closeOnConfirm: true,
        closeOnCancel: false }, 
        function(isConfirm){   
            if (isConfirm) { 
              $.ajax({
                url : host+"Slideshow/delete_crop/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                  $('#modal-crop').modal("hide");
                  toastr.error("Deleteting data success","Information");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    toastr.error("Failed deleting data","Information");
                    get_what_expect();
                }
              });
            } 
            else {
                swal("Canceled", "", "error");   
            } 
      });
}
 <div class="panel panel-color panel-custom">   
	<div class="container" style="margin-top: 10px;text-align: initial;">
	<form id="formsubscriber" autocomplete="off">
	   	<div class="form-group">
	      <label for="email"><i class="ti-pencil-alt pr-10"></i><?=  $this->lang->line("email"); ?> :</label>
	      <input type="email" class="form-control" name="email" id="email">
	      <span class="help-block"></span>
	 	</div>
	  	<div class="form-group">
	      <label for="Name"><i class="ti-pencil-alt pr-10"></i><?= $this->lang->line("name"); ?> :</label>
	      <input type="Name" class="form-control" name="Name" id="Name">
	      <span class="help-block"></span>
	  	</div>
	</form>
	</div>
    <div class="btn-group">
       <button onclick="subscriber()" id="btn_subscriber" class="blog-slider__button"><?= $this->lang->line("send"); ?></button>
    </div>
</div>

<script type="text/javascript">
	function subscriber(){
    $("#btn_subscriber").button("loading");
    $('.form-group,div').removeClass('has-error'); // clear error class
    $('.help-block').empty();
    var form = $('#formsubscriber')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    $.ajax({
        url: host+ 'api/subscriber',
        type: "POST",
        data: formData,
        mimeType: "multipart/form-data", // upload
        contentType: false, // upload
        cache: false, // upload
        processData: false, //upload
        dataType: "JSON",
        success: function(data) {
            if(data.status) //ifsuccess close modal and reload ajax table
            {
                $('#formsubscriber')[0].reset();
                swal('',data.message,'success');
            }
            else{
                if(data.inputerror) {
                    for(var i = 0; i < data.inputerror.length; i++) {
                        label = $('[name="' + data.inputerror[i] + '"]').prev().text();
                        label = data.error_string[i];
                        if(bahasa == "english") {
                            error_msg = "please fill out " + label;
                        } else{
                            error_msg = label + " tidak boleh kosong";
                        }
                        if(label != ''){
                            error_msg = label;
                        }
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(error_msg);
                    }
                }
            }
            $("#btn_subscriber").button("reset");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error Send Message');
            console.log(jqXHR.responseText);
            $("#btn_subscriber").button("reset");
        }
    });
}
</script>
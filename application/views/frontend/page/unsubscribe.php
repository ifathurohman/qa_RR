 <header class="banner text-white bg-cover" style="background: url('http://qa.rumahruth.rcelectronic.co.id/aset/img/history/Rumah singgah ibu hamil - Rumah aman ibu hamil-History.jpg');background-size: cover;background-position: center;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
      </div>
    </div>
  </div>
</header>
<section class="buy-report div-contact showcase vsubscriber data_page page_data" data-key="<?= $code ?>">
    <div class="container-fluid p-0" data-aos="fade-down">
      <!-- <div class="row no-gutters" style="background-image: url('aset/img/section-buy-reports.jpg');background-size: cover;background-position: center;" > -->
      <div class="row no-gutters">
          <div class="col-lg-7 bg-white" data-aos="fade-right" data-key="<?= $code ?>">
                 <div class="container bg-center">
                    <h4 style="text-align: center;"><?= $email ?></h4>
                    <h4 style="text-align: center; padding-top: 10px;padding-bottom: 10px"><?= $this->lang->line("unsubs"); ?></h4>
                    <span><?= $this->lang->line('unsubs_info') ?></span>
                    <h5><?= $this->lang->line('unsubs_reason') ?></h5>
                    <ul class="unsub-options" style="margin-right: 10%;">
                        <li1>
                            <label class="radio" for="r5"><?= $this->lang->line('unsubs_reason2') ?></span></label>
                            <textarea maxlength="225" id="unsub-reason-desc" name="unsub-reason-desc" style="display: block;" row="2" cols="20" class="required"></textarea>
                            <span class="help-block"></span>
                        </li1>
                        <li1><input class="formEmailButton" id="btnSave" type="submit" name="submit" onclick="unsubscribe()" value="<?= $this->lang->line("send"); ?>"></li1>
                    </ul>
                </div>
          </div>
          <div class="col-lg-5 text-white buy-report-right" data-aos="fade-up">
              <img src="<?= site_url('aset/img/vision_mission/Rumah singgah ibu hamil - Rumah aman ibu hamil-World.png'); ?>" style="max-width: 100%;">
          </div>
      </div>
    </div>
</section>

<script type="text/javascript">
    function unsubscribe(){
    $("#btnSave").button("loading");
    $('.has-error').removeClass('has-error');
    $('.help-block').text('');

    page_data   = $('.page_data').data();
    key         = page_data.key;
    reason      = $('#unsub-reason-desc').val();

    if(reason != ""){
        data_post = {
            key     : key,
            reason  : reason,
        }
        $.ajax({
            url: host + "api/save_unsubscribe",
            type: "POST",
            data: data_post,
            dataType: "JSON",
            success: function(data) {
                $("#btnSave").button("reset");
                if(data.status){
                    $('#unsub-reason-desc').val('');
                    swal('',data.message, 'success');
                    window.location.replace('http://qa.rumahruth.rcelectronic.co.id');
                }else{
                    swal('',data.message, 'warning');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
                $("#btnSave").button("reset");
            }
        });
    }else{
        if(bahasa == "english") {
            error_msg = "please fill out reason";
        } else{
            error_msg = "Alasan tidak boleh kosong";
        }
        $('#unsub-reason-desc').parent().addClass('has-error');
        $('#unsub-reason-desc').next().text(error_msg);
        $("#btnSave").button("reset");
    }
}
</script>

<style type="text/css">/* Forms */
    label {
        display:block;
        width:auto;
        margin-top:8px;
        font-weight:bold;
    }
    input, textarea, select {
        display:block;
        margin:0;
        padding:10px;
        background:#fff;
        width:100%;
        border:2px solid #d0d0d0 !important;
        border-radius:3px;
        -webkit-appearance: none;
    }
    .field-group input, select, textarea, .dijitInputField {
        font-size: 14px;
    }
    textarea {
        font:14px/18px 'Helvetica', Arial, sans-serif;
        width:100%;
        max-height:150px;
        height:150px;
        min-height: 150px;
        overflow:auto;
    }

    input:focus, textarea:focus, select:focus, .focused-field .subfields {
        border-color:#5d5d5d !important;
        outline:none;
    }
    .formEmailButton{
        margin-top: 10px;
    }
    .vsubscriber{
        padding: 20px;
    }
    .vsubscriber .container{
        max-width: 500px;
        border: 3px solid #5b5b5b;
        padding: 20px;
        border-radius: 10px;
    }
</style>
<header class="banner text-white bg-cover" style="background: url('aset/img/contact_us/Rumah singgah ibu hamil - Rumah aman ibu hamil-Contact_US.jpg');background-size: cover;background-position: center;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
        </div>
      </div>
    </header>

    <section class="pt-zero text-left">  
      <div class="container-fluid">
        <div class="div-content">
          <div class="row">
            <div class="col-lg-6">
              <div class="div showcase-text">
                <div class="section-title" data-aos="fade-down" style="padding-top: 30px"><?= $this->lang->line('contact_us'); ?></div>
                  <div class="border-bottom-blue"></div>
                    <p class="lead text-section" style="padding-top: 30px;padding-left: 10px">
                      <?php $CompanyWhatsapp = $this->main->set_('CompanyWhatsapp'); if($CompanyWhatsapp && $CompanyWhatsapp != "#"): ?>
                      <tr>
                        <td  class="vertical-top"><i class="fab fa-whatsapp"></i></td>
                        <td><a href="https://api.whatsapp.com/send?phone=<?=  $this->main->telp($CompanyWhatsapp); ?>"><?= $CompanyWhatsapp; ?></a></td>
                      </tr>
                      <?php endif; ?>
                    </p>
                    <p class="lead text-section" style="padding-top: 30px;padding-left: 10px">
                      <?php $EmailGeneral = $this->main->set_('EmailGeneral'); if($EmailGeneral && $EmailGeneral != "#"): ?>
                        <tr>
                          <td  class="vertical-top"><i class="fa fa-envelope"></i></td>
                          <td><a href="mailto:<?= $EmailGeneral; ?>"><?= $EmailGeneral; ?></a></td>
                        </tr>
                      <?php endif; ?>
                    </p>
                    <p class="lead text-section" style="padding-top: 30px;padding-left: 10px">
                      <?php $SocialFacebook = $this->main->set_('SocialFacebook'); if($SocialFacebook && $SocialFacebook != "#"): ?>
                        <tr>
                          <td  class="vertical-top"><i class="fab fa-facebook-f"></i></td>
                          <td><a href="<?= $SocialFacebook ?>">Facebook</a></td>
                        </tr>
                      <?php endif; ?>
                    </p>
                    <p class="lead text-section" style="padding-top: 30px;padding-left: 10px">
                      <?php $SocialInstagram = $this->main->set_('SocialInstagram'); if($SocialInstagram && $SocialInstagram != "#"): ?>
                        <tr>
                          <td  class="vertical-top"><i class="fab fa-instagram"></i></td>
                          <td><a href="<?= $SocialInstagram ?>">Instagram</a></td>
                        </tr>
                      <?php endif; ?>
                    </p>
                    <hr>
                  </div>
              </div>
            <div class="col-lg-6">
              <div class="div showcase-text custom" data-aos="fade-right">
                <div class="box-form box-shadow p-2r">
                  <p><?= $this->lang->line('contact-message'); ?></p>
                  <?php $this->load->view('frontend/form/contact_us'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section  pt-zero text-left">  
      <div class="container-fluid">
        <div class="div-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title" data-aos="fade-down" style="padding-bottom: 30px;"><?= $this->lang->line('location'); ?></div>
              <div class="map" style="z-index: -1">
                <?php $CompanyLocation = $this->main->set_('CompanyLocation'); if($CompanyLocation): echo $CompanyLocation; endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style type="text/css">
      .section {
        padding-top: 0rem;
        padding-bottom: 0rem;
      }
      .box-form {
        width: 100%;
        background: #e6e6e6b5;
        margin-top: 3rem;
        margin-bottom: 3rem;
        border-radius: 10px;
      }
      .btn-blue {
        background: #b1b1b1;
        color: #fff !important;
      }
      @media screen and (min-width: 1280px) {
        .custom{
            position: absolute;
            z-index: 10 ;
         }
      }
     
    </style>
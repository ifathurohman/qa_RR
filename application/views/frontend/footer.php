<a href="#" class="scrollToTop"><span class="fa fa-arrow-up"></span></a>
    <footer class="footer bg-footer ">
      <div class="container-fluid container-small">
        <div class="row no-gutters" >

          <div class="col-lg-2" data-aos="fade-up">
            <h3 class="title">Useful Link</h3>
            <ul class="list-link">
            <?php 
            foreach($this->main->list_link("main_menu") as $a):
              echo '<li><a href="'.$a->link.'" class="link">'.$a->name.'</a></li>';
            endforeach; ?>
            </ul>
          </div>
          <div class="col-lg-2" data-aos="fade-up">
            <h3 class="title">Social Media</h3>
            <table class="list-link list-link-social list-link-icon">
            <?php 
            foreach($this->main->list_link("social_media") as $a):
              if($a->link && $a->link != "#"):
                echo '<tr><td><i class="'.$a->icon.'"></i> </td><td><a href="'.$a->link.'" class="link" target="_blank">'.$a->name.'</a></td></tr>';
              endif;
            endforeach; 
            ?>
            </table>
          </div>
          <div class="col-lg-8" data-aos="fade-up">
            <h3 class="title"><?= $this->lang->line('contact_us'); ?></h3>
            <table class="list-link list-link-icon">
              <?php $CompanyAddress = $this->main->set_('CompanyAddress'); if($CompanyAddress && $CompanyAddress != "#"): ?>
              <tr class="mb-20">
                <td class="vertical-top" ><i class="fas fa-map-marker-alt"></i></td>
                <td class="pb-1r"> <?= $CompanyAddress; ?></td>
              </tr>
              <?php endif; ?>
              <?php $CompanyTelephone = $this->main->set_('CompanyTelephone'); if($CompanyTelephone && $CompanyTelephone != "#"): ?>
              <tr>
                <td  class="vertical-top"><i class="fa fa-phone"></i></td>
                <td>Telephone : <a href="tel:<?= $this->main->telp($CompanyTelephone); ?>" class="blue"><?= $CompanyTelephone; ?></a></td>
              </tr>
              <?php endif; ?>
              <?php $CompanyCallCenter = $this->main->set_('CompanyCallCenter'); if($CompanyCallCenter && $CompanyCallCenter != "#"): ?>
              <tr>
                <td  class="vertical-top"><i class="fa fa-whatsapp"></i></td>
                <td>Call Center : <a href="https://api.whatsapp.com/send?phone=<?= $this->main->telp($CompanyCallCenter); ?>" class="blue"><?= $CompanyCallCenter; ?></a></td>
              </tr>
              <?php endif; ?>
              <?php $CompanyWhatsapp = $this->main->set_('CompanyWhatsapp'); if($CompanyWhatsapp && $CompanyWhatsapp != "#"): ?>
              <tr>
                <td  class="vertical-top"><i class="fab fa-whatsapp"></i></td>
                <td><a href="https://api.whatsapp.com/send?phone=<?=  $this->main->telp($CompanyWhatsapp); ?>" class="blue"><?= $CompanyWhatsapp; ?></a></td>
              </tr>
              <?php endif; ?>
              <?php $CompanyFax = $this->main->set_('CompanyFax'); if($CompanyFax && $CompanyFax != "#"): ?>
              <tr>
                <td  class="vertical-top <?php if($CompanyTelephone): echo 'invisible'; endif;?>"><i class="fa fa-phone"></i></td>
                <td>Fax : <a href="tel:<?= $CompanyFax; ?>" class="blue"><?= $CompanyFax; ?></a></td>
              </tr>
              <?php endif; ?>
              <?php $EmailGeneral = $this->main->set_('EmailGeneral'); if($EmailGeneral && $EmailGeneral != "#"): ?>
              <tr>
                <td  class="vertical-top"><i class="fa fa-envelope"></i></td>
                <td><a href="mailto:<?= $EmailGeneral; ?>" class="blue"><?= $EmailGeneral; ?></a></td>
              </tr>
              <?php endif; ?>
              <?php $EmailTechnical = $this->main->set_('EmailTechnical'); if($EmailTechnical && $EmailTechnical != "#"): ?>
              <tr>
                <td  class="vertical-top <?php if($EmailGeneral): echo 'invisible'; endif;?>"><i class="fa fa-envelope"></i></td>
                <td>Technical : <a href="mailto:<?= $EmailTechnical; ?>" class="blue"><?= $EmailTechnical; ?></a></td>
              </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
        <div class="row footer-bottom" data-aos="fade-up">
          <div class="col-lg-12 h-100 text-center my-auto">
            <ul class="list-inline mb-20">
              <li class="list-inline-item">
                <a href="javascript:;">Privacy Policy</a>
              </li>
              <li class="list-inline-item">|</li>
              <li class="list-inline-item">
                <a href="javascript:;">Refund Policy</a>
              </li>
             <!--  <li class="list-inline-item">|</li>
              <li class="list-inline-item">
                <a href="<?= site_url('terms-of-service'); ?>" target="_blank">Terms Of Service</a>
              </li> -->
            </ul>
            <p class="text-muted small mb-4 mb-lg-0"><a href="https://rcelectronic.co.id" target="_blank">Copyright &copy; since 2019 - RC Electronic, Cv</a></p>
          </div>
        </div>
      </div>
    </footer>
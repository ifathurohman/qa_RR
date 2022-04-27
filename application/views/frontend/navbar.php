<div class="fixed-top contact-top" style="z-index: 1031;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <ul class="list-contact">
            <?php $CompanyWhatsapp = $this->main->set_('CompanyWhatsapp'); if($CompanyWhatsapp && $CompanyWhatsapp != "#"): ?>
            <li class="item"><a href="https://api.whatsapp.com/send?phone=<?=  $this->main->telp($CompanyWhatsapp); ?>"><i class="fab fa-whatsapp"></i> <?= $CompanyWhatsapp; ?></a></li>
            <?php endif; ?>
            <!-- <?php $CompanyWhatsapp = $this->main->set_('CompanyWhatsapp2'); if($CompanyWhatsapp && $CompanyWhatsapp != "#"): ?>
            <li class="item"><a href="https://api.whatsapp.com/send?phone=<?=  $this->main->telp($CompanyWhatsapp); ?>"><i class="fab fa-whatsapp"></i> <?= $CompanyWhatsapp; ?></a></li>
            <?php endif; ?> -->
          </ul>
        </div>
        <div class="col-lg-6 col-xs-6 text-right">
          <ul class="list-contact">
            <li class="item dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="false" role="button">
                <?php 
                  if($this->session->bahasa == "indonesia"): 
                    echo '<span class="flag-icon flag-icon-id mr-10"></span>Indonesia';
                  else:
                    echo '<span class="flag-icon flag-icon-us mr-10"></span>English';
                  endif;
                ?>
              </a>
              <ul class="list-bahasa dropdown-menu" role="menu" style="padding: 25px">
                <?php foreach($this->main->list_link('bahasa') as $a): ?>
                <li role="presentation">
                  <a href="<?= $a->link;  ?>" role="menuitem">
                    <span class="<?= $a->icon; ?>"></span> <?= $a->name; ?></a>
                </li>
                <?php endforeach; ?>
              </ul>
            </li>
            <!-- <li class="item m-tb-zero">
                <a href="<?= site_url('people-shape-faq'); ?>" class="btn btn-custom btn-radius mt-5p mb-5p" style="line-height: 15px;min-width: 100px;"><?= $this->lang->line('help_center'); ?></a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top frontend" >
      <div class="container-fluid navbar-container custom-fluid">
        <a class="navbar-brand" href="<?= site_url(); ?>"><img alt=""  src="<?= $this->main->set_('Logo'); ?>" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="true" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" style="">
          <ul class="navbar-nav ml-auto">
          <?php 
            $MainMenu = $this->main->set_("MainMenu");
            $MainMenu = json_decode($MainMenu);
            if(count($MainMenu) > 0):  
          ?>
          <?php foreach($MainMenu as $a): ?>
             <?php if($a->ContentID == "about-us.html"):?>
              <li class="nav-item dropdown dropdown-large">
               <!--  <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownPortfolio">Products</a> -->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?= $this->lang->line('about_us'); ?></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-dark p-zero margin-zero open" aria-labelledby="navbarDropdownPortfolio">
                  <div class="row-dropdown">
                    <div class="dropdown-main p-r-zero">
                      <a class="dropdown-item" href="<?= site_url('about-us'); ?>"><?= $this->lang->line('vision_mission'); ?></a>
                      <a class="dropdown-item" href="<?= site_url('history'); ?>"><?= $this->lang->line('history'); ?></a>
                    </div>   
                  </div>
                </div>
              </li>
              <?php elseif($a->ContentID == "galery.html"): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('galery'); ?>"><?= $this->lang->line('galery'); ?></a>
              </li>
             <?php elseif($a->ContentID == "service.html"): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('service'); ?>"><?= $this->lang->line('service'); ?></a>
              </li>
            <?php elseif($a->ContentID == "article.html"): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('article'); ?>"><?= $this->lang->line('article'); ?></a>
              </li>
            <?php elseif($a->ContentID == "contact-us.html"): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('contact-us'); ?>"><?= $this->lang->line('contact_us'); ?></a>
              </li>
            <?php elseif($a->ContentID == "donation.html"): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('donation'); ?>"><?= $this->lang->line('donation'); ?></a>
              </li>
            <?php elseif ($a->ContentID == "home"): ?>
               <li class="nav-item">
                <a class="nav-link" href="<?= site_url(); ?>"><?= $this->lang->line('home'); ?></a>
              </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $a->Url; ?>"><?= $a->Name ?></a>
            </li>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php endif; ?>
            <li class="nav-item mobile dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <?php 
                  if($this->session->bahasa == "indonesia"): 
                    echo '<span class="flag-icon flag-icon-id mr-10"></span> Indonesia';
                  else:
                    echo '<span class="flag-icon flag-icon-us mr-10"></span> English';
                  endif;
                ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-dark p-zero margin-zero" aria-labelledby="navbarDropdownPortfolio">
                  <div class="row-dropdown">
                    <div class="dropdown-main p-r-zero">
                    <?php foreach($this->main->list_link('bahasa') as $a): ?>
                    <a class="dropdown-item" href="<?= $a->link; ?>"><span class="<?= $a->icon; ?>"></span> <?= $a->name; ?></a>
                    <?php endforeach; ?>
                    </div> 
                  </div>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
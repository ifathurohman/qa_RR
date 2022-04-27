<div class="navbar navbar-default" role="navigation">
   <div class="container">
      <div class="">
         <div class="pull-left">
            <button class="button-menu-mobile open-left waves-effect waves-light">
            <i class="md md-menu"></i>
            </button>
            <span class="clearfix"></span>
         </div>
         
         <ul class="nav navbar-nav navbar-right pull-right">
            <li class="hidden-xs">
               <a class="text-black" style="color:#36404a !important;line-height: unset;height: 60px;padding: 10px 10px;">
                  <span class="profile-name"><?= $this->session->Name; ?> </span>
                  <span style="display: block;font-size: 9pt;" class="text-dark"><?= $this->session->HakAkses; ?></span></a>
            </li>
            <li class="dropdown top-menu-item-xs">
               <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                  <img src="<?= base_url($this->main->get_image_profile()); ?>" alt="user-img" class="img-circle">
               </a>
               <ul class="dropdown-menu">
                  <li><a href="<?= site_url('user-edit') ?>"><i class="ti-crown  m-r-10 text-custom"></i> <?= $this->session->Name; ?></a></li>
                  <li><a href="<?= site_url('user-edit') ?>"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                  <!-- <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li> -->
                  <!-- <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li> -->
                  <li class="divider"></li>
                  <li><a href="<?= site_url('logout'); ?>"><i class="ti-power-off m-r-10 text-danger"></i> Log Out</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <!--/.nav-collapse -->
   </div>
</div>
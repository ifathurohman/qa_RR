<div class="left side-menu">
   <div class="sidebar-inner slimscrollleft">
      <!--- Divider -->
      <div id="sidebar-menu">
         <ul>
            <li class="has_sub"><a href="<?= site_url("dashboard"); ?>" class="waves-effect"><i class="ti-dashboard"></i><span>Dashboard<span></a></li>
            <?php 

            $menu = $this->main->menu("page_backend");
            if(count($menu) > 0):
               foreach($menu as $a):
                  $Icon = ' ti-layout-width-full';
                  if($a->Icon){ $Icon = $a->Icon; }
                  echo '<li class="has_sub"><a href="'.site_url($a->Url).'" class="waves-effect"><i class="'.$Icon.'"></i><span>'.$a->Name.'<span></a></li>';
               endforeach;
            endif;
            ?>
            <?php if(strtolower($this->session->HakAkses) == "rc" || strtolower($this->session->HakAkses) == "administrator"):?>
            <li class="has_sub">
               <a href="javascript:void(0);" class="waves-effect">
               <i class="ti-settings"></i> 
               <span> Setting </span> 
               <span class="menu-arrow"></span>
               </a>
               <ul class="list-unstyled">
                  <li><a href="<?= site_url("menu"); ?>">Menu / Route</a></li>
                  <li><a href="<?= site_url("user-privileges"); ?>">User Privileges</a></li>
               </ul>
            </li>
            <?php endif; ?>
         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<div class="row page page-data" data-hakakses="<?= $this->session->hak_akses; ?>" data-page_name="<?= $title; ?>" data-modul="<?= $modul; ?>" data-url_modul="<?= $url_modul; ?>" >
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="div-table-list">
         <ul class="nav nav-menu nav-pills mb-3r">
            <li><a href="<?= site_url("settings/general"); ?>">General</a></li>
            <li><a href="<?= site_url("settings/writing"); ?>">Writing</a></li>
            <li><a href="<?= site_url("settings/main-menu"); ?>">Menu</a></li>
            <li><a href="<?= site_url("settings/slideshow"); ?>">Slideshow</a></li>
            <li><a href="<?= site_url("settings/social-media"); ?>">Social Media</a></li>
         </ul>
         <form enctype="multipart/form-data" method="post"  id="<?= $modul; ?>">
            <?php if($modul == "general"): ?>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span class="btn-group pull-right">
                  <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default btn-sm">Save Setting</a>
                  </span>
                  <span>Site Profile</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                           <div class="div-img-preview">
                              <div class="main-img-preview">
                                 <img class="thumbnail img-preview" src="#" title="Preview Logo">
                              </div>
                              <div class="input-group">
                                 <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                                 <div class="input-group-btn">
                                    <div class="fileUpload btn btn-danger fake-shadow">
                                       <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                                       <input id="logo-id" name="Logo" type="file" class="attachment_upload">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <p class="help-block">* Upload your logo.</p>
                        </div>
                     </div>
                     <div class="col-sm-9">
                        <div class="form-group">
                           <label>Site Title</label>
                           <input type="text" name="SiteTitle" class="form-control">
                        </div>
                        <div class="form-group">
                           <label>Site Tagline</label>
                           <input type="text" name="SiteTagLine" class="form-control">
                        </div>
                        <div class="form-group">
                           <label>Site Timezone</label>
                           <select name="TimeZone" class="form-control select2">
                           <?php 
                              $list   = $this->main->generate_timezone_list();
                              $group  = array();
                              foreach($list as $a):
                                $group_name = explode("/", $a->Value)[0];
                                if(!in_array($group_name, $group)){
                                    $group[] = $group_name;
                                }
                              endforeach;
                              foreach($list as $a):
                                echo '<option value="'.$a->Value.'">'.explode(' ', $a->Name)[0]." ".explode("/", $a->Name)[1].'</option>';
                              endforeach;
                              ?>
                           </select>
                           <span class="help-block">Choose a city in your timezone. You might want to follow our guess: <a href="javascript:;" class="blue" onclick="select_timezone('Asia/Jakarta')">Select Asia/Jakarta</a></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span>Company Info</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Name</label>
                           <input type="text" name="CompanyName" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Vision</label>
                           <input type="text" name="CompanyVision" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Mission</label>
                           <input type="text" name="CompanyMission" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Description</label>
                           <textarea type="text" name="CompanyDescription" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Address1</label>
                           <textarea type="text" name="CompanyAddress" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Address2</label>
                           <textarea type="text" name="CompanyAddress1" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Call Center</label>
                           <input type="text" name="CompanyCallCenter" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Telephone</label>
                           <input type="text" name="CompanyTelephone" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email</label>
                           <input type="text" name="Email" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Whatsapp1</label>
                           <input type="text" name="CompanyWhatsapp" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email2</label>
                           <input type="text" name="Email1" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Whatsapp1</label>
                           <input type="text" name="CompanyWhatsapp1" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email2</label>
                           <input type="text" name="Email2" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Whatsapp3</label>
                           <input type="text" name="CompanyWhatsapp2" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Fax</label>
                           <input type="text" name="CompanyFax" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email General</label>
                           <input type="text" name="EmailGeneral" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email Technical</label>
                           <input type="text" name="EmailTechnical" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Website</label>
                           <input type="text" name="CompanyWebsite" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Business Hours</label>
                           <input type="text" name="CompanyBusinessHours" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span>Company Location</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Location</label>
                           <textarea type="text" name="CompanyLocation" class="form-control"></textarea>
                           <span class="help-block red">*user google map embed code</span>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div id="MAP" style="max-height: 400px;overflow: hidden;"></div>
                     </div>
                  </div>
               </div>
            </div>
             <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span>Company Location1</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Company Location1</label>
                           <textarea type="text" name="CompanyLocation1" class="form-control"></textarea>
                           <span class="help-block red">*user google map embed code</span>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div id="MAP" style="max-height: 400px;overflow: hidden;"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span class="btn-group pull-right">
                  <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default btn-sm">Save Setting</a>
                  </span>
                  <span>Contact Us</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Jakarta Email</label>
                           <input type="text" name="ContactUsJakartaEmail" class="form-control">
                           <label>Jakarta Address</label>
                           <textarea type="text" name="ContactUsJakartaAddress" class="form-control"></textarea>
                           <label>Jakarta List Contact</label>
                           <textarea type="text" name="ContactUsJakartaList" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Bandung Email</label>
                           <input type="text" name="ContactUsBandungEmail" class="form-control">
                           <label>Bandung Address</label>
                           <textarea type="text" name="ContactUsBandungAddress" class="form-control"></textarea>
                           <label>Bandung List Contact</label>
                           <textarea type="text" name="ContactUsBandungList" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Semarang Email</label>
                           <input type="text" name="ContactUsSemarangEmail" class="form-control">
                           <label>Semarang Address</label>
                           <textarea type="text" name="ContactUsSemarangAddress" class="form-control"></textarea>
                           <label>Semarang List Contact</label>
                           <textarea type="text" name="ContactUsSemarangList" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <?php if($modul == "writing"): ?>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span class="btn-group pull-right">
                  <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default btn-sm">Save Setting</a>
                  </span>
                  <span>Content types</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Feature Post</label>
                           <div>
                              <span class="mr-10">Display </span>
                              <input type="number" name="FeaturePostLimit" class="form-controlx width-75p number" min="1" max="25">
                              <span class="ml-10">per page</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Blog Post</label>
                           <div>
                              <span class="mr-10">Display </span>
                              <input type="number" name="PostLimitBlog" class="form-controlx width-75p number" min="1" max="25">
                              <span class="ml-10">per page</span>
                           </div>
                           <span class="help-block">On blog pages, the number of posts to show per page.</span>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Featured Article</label>
                           <div>
                              <span class="mr-10">Display </span>
                              <input type="number" name="FeatureNewsLimit" class="form-controlx width-75p number" min="1" max="25">
                              <span class="ml-10">per page</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>News And Events Post</label>
                           <div>
                              <span class="mr-10">Display </span>
                              <input type="number" name="PostLimitNews" class="form-controlx width-75p number" min="1" max="25">
                              <span class="ml-10">per page</span>
                           </div>
                           <span class="help-block">On news and events pages, the number of posts to show per page.</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <?php if($modul == "slideshow"): ?>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span>Slideshow</span>
               </div>
               <!-- <input type="hidden" name="ArticleID">
               <input type="hidden" name="ArticleIDeng"> -->
               <div class="panel-body" style="padding: 0px">
                 <ul class="nav nav-tabs" style="background: #ced0d2">
                     <li class="active tab-indo" style="width: 50%;text-align: center;" onclick="language('indonesia')"><a data-toggle="tab" href="#home">Indonesia</a></li>
                     <li class="tab-eng" style="width: 50%;text-align: center;" onclick="language('english')"><a data-toggle="tab" href="#menu1">English</a></li>
                 </ul>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="div-img-preview mb-20">
                           <div class="main-img-preview">
                              <img class="thumbnail img-preview h200" src="#" title="Preview Logo">
                           </div>
                           <div class="input-group">
                              <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                              <div class="input-group-btn">
                                 <div class="fileUpload btn btn-danger fake-shadow">
                                    <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                                    <input id="logo-id" name="Image" type="file" class="attachment_upload">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group vindo">
                           <input type="hidden" name="AttachmentID" class="form-control" placeholder="Name">
                           <input type="text" name="Name" class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group veng">
                           <input type="hidden" name="AttachmentIDeng" class="form-control" placeholder="Nameeng">
                           <input type="text" name="Nameeng" class="form-control" placeholder="Title">
                        </div>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                        <div class="form-group vindo">
                           <select name="Position" class="form-control">
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                              <option value="center">Center</option>
                           </select>
                        </div>
                        <div class="form-group veng">
                           <select name="Positioneng" class="form-control">
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                              <option value="center">Center</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                        <div class="form-group vindo">
                           <input type="color" name="NameColor" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group veng">
                           <input type="color" name="NameColoreng" class="form-control" placeholder="Name">
                        </div>
                     </div>
                     <div class="col-sm-12 ">
                        <span class="btn btn-sm btn-white mb-10" data-toggle="collapse" data-parent="#accordion" href="#show-more">show more</span>
                        <div id="show-more" class="collapse">                        
                           <div class="form-group vindo">
                              <textarea type="text" name="Description" class="form-control " placeholder="Description" maxlength="200"></textarea>
                           </div>
                           <div class="form-group veng">
                              <textarea type="text" name="Descriptioneng" class="form-control " placeholder="Description" maxlength="200"></textarea>
                           </div>
                           <div class="form-group " >
                             <div class="input-group mb-15" id="BtnID-1">
                               <span class="input-group-addon" style="width: 10%">Button Link</span>
                               <input type="hidden" name="BtnID[]" value="1">
                               <input type="text" name="BtnName[]" class="BtnName form-control pull-left" style="width: 30%;" placeholder="Title Button">
                               <input type="text" name="BtnLink[]" class="BtnLink form-control pull-left" style="width: 50%" placeholder="Link Button">
                               <select name="BtnColor[]" class="BtnColor form-control pull-left" style="width: 20%">
                                 <option value="blue">Blue</option>
                                 <option value="white">White</option>
                               </select>
                            </div>
                           </div>
                        </div>
                      </div>
                     <div class="col-sm-12">
                        <div class="btn-group width-100">                        
                           <a href="javascript:;" onclick="reset_form(this)" data-modul="<?= $modul; ?>" class="btn btn-white width-50">Reset</a>
                           <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default width-50">Save Slideshow</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <ul class="list-data-slideshow list-drag ">
            </ul>
            <?php endif; ?>
            <?php if($modul == "main-menu"): ?>
            <div class="panel panel-default">
               <div class="panel-heading clearfix">
                  <span>Page</span>
               </div>
               <!-- <div class="panel-body"></div> -->
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <ul class="list-menu-content taskList " id="main-menu-notfix" style="min-height: 200px;">
                     <?php 
                     $ArrayContentID = array();
                     $MainMenu = $this->main->set_("MainMenu");
                     $MainMenu = json_decode($MainMenu);
                     foreach($MainMenu as $a):
                        $ArrayContentID[] = $a->ContentID;
                     endforeach;
                     foreach($this->main->list_link("main_menu") as $a):
                        $ContentID = $this->main->link($a->name);
                        if(!in_array($ContentID, $ArrayContentID)):
                           $item = '<li class="item" data-id="'.$ContentID.'" data-name="'.$a->name.'">';
                           $item .= '<input type="hidden" name="ContentID[]" value="'.$ContentID.'">';
                           $item .= '<input type="hidden" name="ContentName[]" value="'.$a->name.'">';
                           $item .= '<input type="hidden" name="ContentUrl[]" value="'.$a->link.'">';
                           $item .= '<input type="hidden" name="ContentType[]" value="MainPage">';
                           $item .= '<span>'.$a->name.'</span>';
                           $item .= '</li>';
                           echo $item;
                        endif;
                     endforeach; ?>
                        
                     <?php if(!in_array("products", $ArrayContentID)):?>
                     <li class="item ui-sortable-handle" data-id="products" data-name="Products">
                        <input type="hidden" name="ContentID[]" value="products">
                        <input type="hidden" name="ContentName[]" value="Products">
                        <input type="hidden" name="ContentUrl[]" value="<?= site_url("products-list"); ?>">
                        <input type="hidden" name="ContentType[]" value="MainPage">
                        <span>Products</span>
                     </li>
                     <?php endif; ?>
                     <?php 
                     foreach($this->api->page("list_data_menu") as $a):
                        if(!in_array($a->ContentID, $ArrayContentID)):
                           if($a->Link == ""):
                              $Link = $this->main->link($a->Name);
                           else:
                              $Link = $a->Link;
                           endif;
                           $Link = site_url($Link); 
                           $item = '<li class="item" data-id="'.$a->ContentID.'" data-name="'.$a->Name.'">';
                           $item .= '<input type="hidden" name="ContentID[]" value="'.$a->ContentID.'">';
                           $item .= '<input type="hidden" name="ContentName[]" value="'.$a->Name.'">';
                           $item .= '<input type="hidden" name="ContentUrl[]" value="'.$Link.'">';
                           $item .= '<input type="hidden" name="ContentType[]" value="Page">';
                           $item .= '<span>'.$a->Name.'</span>';
                           $item .= '</li>';
                           echo $item;
                        endif;
                     endforeach; ?>
                  </ul>
               </div>
            </div>
            <div class="panel panel-default mt-2r">
               <div class="panel-heading clearfix">
                  <span class="btn-group pull-right">
                  <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default btn-sm">Save Setting</a>
                  </span>
                  <span>Main Menu</span>
               </div>
               <!-- <div class="panel-body"></div> -->
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <ul class="list-menu-content taskList" style="min-height: 200px;" id="main-menu-fix">
                  <?php 
                  foreach($MainMenu as $a):
                     $item = '<li class="item" data-id="'.$a->ContentID.'" data-name="'.$a->Name.'">';
                     $item .= '<input type="hidden" name="ContentID[]" value="'.$a->ContentID.'">';
                     $item .= '<input type="hidden" name="ContentName[]" value="'.$a->Name.'">';
                     $item .= '<input type="hidden" name="ContentUrl[]" value="'.$a->Url.'">';
                     $item .= '<input type="hidden" name="ContentType[]" value="'.$a->Type.'">';
                     $item .= '<span>'.$a->Name.'</span>';
                     $item .= '</li>';
                     echo $item;
                  endforeach;
                  ?>
                  </ul>
               </div>
            </div>

            <?php endif; ?>
            <?php if($modul == "social-media"): ?>
            <div class="panel panel-default">
               <div class="panel-heading clearfix border-bottom-1ddd">
                  <span class="btn-group pull-right">
                  <a href="javascript:;" onclick="save_setting(this)" data-modul="<?= $modul; ?>" class="btn btn-default btn-sm">Save Setting</a>
                  </span>
                  <span>Social Media</span>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Facebook</label>
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fab fa-facebook-f"></i></span>
                              <input type="text" name="SocialFacebook" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Instagram</label>
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fab fa-instagram"></i></span>
                              <input type="text" name="SocialInstagram" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>LinkedIn</label>
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fab fa-linkedin-in"></i></span>
                              <input type="text" name="SocialLinkedIn" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif; ?>
         </form>
      </div>
   </div>
</div>
<script src="<?= base_url('aset/js/backend/general_setting.js'); ?>"></script>



<!-- Modal -->
<div id="modal" class="modal modal-65 fade modal-fade-in-scale-up" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content p-0 b-0">
          <div class="panel panel-color panel-custom">
              <div class="panel-heading"> 
                  <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title">Modal Title</h3>
              </div> 
              <div class="panel-body p-0"> 
                  <form class="col-sm-12" method="post" id="form">
                    <input type="hidden" name="HakAksesID">
                    <div class="form-group padding-25">
                       <label class="col-md-4 control-label">Name</label>
                       <div class="col-md-8">
                          <input type="text" name="Name" class="form-control">
                          <span class="help-block"></span>
                       </div>
                    </div>
                    <div class="col-lg-12"> 
                    <?php foreach($modul as $moduls): ?>

                      <ul class="nav nav-tabs tabs">
                          <?php $i = 1; foreach($array as $ar): if($i++ == 1): $aktif = "active"; else: $aktif=""; endif;?>
                          <li class="tab <?= $aktif; ?>" role="presentation">
                            <a data-toggle="tab" href="#<?= str_replace(" ", "_",$ar[1]).$moduls; ?>" aria-controls="<?= str_replace(" ", "_",$ar[1]); ?>" role="tab">
                            <?= $ar[1]; ?>
                            </a>
                          </li>
                          <?php endforeach; ?>
                      </ul> 
                      <div class="tab-content " style="box-shadow: none;">
                        <?php
                        $i = 1; 
                        foreach($array as $ar): 
                          if($i++ == 1): 
                            $aktif = "active"; 
                          else: 
                            $aktif=""; 
                          endif;

                          $modulsx = $moduls."-".$ar[1];

                        ?>
                        <div class="tab-pane <?= $aktif; ?>" id="<?= str_replace(" ", "_",$ar[1]).$moduls; ?>" role="tabpanel">
                          <table style="width: 100%" class="<?= $modulsx; ?>">
                            <tr>
                              <td></td>
                              <td>
                                <div class="checkbox checkbox-primary">
                                  <input id="allview-<?= $modulsx; ?>" class="icheckbox-primary" type="checkbox" value="view" data-modul="<?= $modulsx; ?>" onclick="cek_all(this)">
                                  <label for="allview-<?= $modulsx; ?>" style="text-transform: lowercase;">All</label>                      
                                </div>
                              </td>
                              <?php if(!in_array($ar[0],array("report"))): ?>
                              <td>
                                <div class="checkbox checkbox-primary">
                                  <input id="alladd-<?= $modulsx; ?>" class="icheckbox-primary" type="checkbox" value="add" data-modul="<?= $modulsx; ?>" onclick="cek_all(this)">
                                  <label for="alladd-<?= $modulsx; ?>" style="text-transform: lowercase;">All</label>                      
                                </div>
                              </td>
                              <td>
                                <div class="checkbox checkbox-primary">
                                  <input id="alledit-<?= $modulsx; ?>" class="icheckbox-primary" type="checkbox" value="edit" data-modul="<?= $modulsx; ?>" onclick="cek_all(this)">
                                  <label for="alledit-<?= $modulsx; ?>" style="text-transform: lowercase;">All</label>                      
                                </div>
                              </td>
                              <td>
                                <div class="checkbox checkbox-primary">
                                  <input id="alldelete-<?= $modulsx; ?>" class="icheckbox-primary" type="checkbox" value="delete" data-modul="<?= $modulsx; ?>" onclick="cek_all(this)">
                                  <label for="alldelete-<?= $modulsx; ?>" style="text-transform: lowercase;">All</label>                      
                                </div>
                              </td>
                              <!-- <td>
                                <div class="checkbox checkbox-primary">
                                  <input id="allapprove-<?= $modulsx; ?>" class="icheckbox-primary" type="checkbox" value="approve" data-modul="<?= $modulsx; ?>" onclick="cek_all(this)">
                                  <label for="allapprove-<?= $modulsx; ?>" style="text-transform: lowercase;">All</label>                      
                                </div>
                              </td> -->
                              <?php endif; ?>

                            </tr>
                          <?php
                            $menu = $this->hakakses->menu($moduls,$ar[0]);
                            if(!empty($menu)):
                              foreach ($menu as $mn):
                            ?>
                            <tr>
                            <td width="200px">
                                <label for="idmenu<?= $mn->MenuID; ?>" style="text-transform: lowercase;"><?= $mn->Name; ?></label>
                                <input type="hidden" name="cekboxID[]"  value="<?= $mn->MenuID; ?>">
                            </td>
                            <td>
                              <div class="checkbox checkbox-primary">
                                <input class="cek-view icheckbox-primary" name="menu[]" id="idmenu<?= $mn->MenuID; ?>" type="checkbox" value="<?= $mn->MenuID; ?>" data-modul="<?= $modulsx; ?>" data-menuid="<?= $mn->MenuID; ?>"onchange="click_view(this)" onclick="click_view(this)">
                                <label for="idmenu<?= $mn->MenuID; ?>" style="text-transform: lowercase;">View</label>                      
                                <!-- <input type="hidden" name="menu[]"  value="<?= $mn->MenuID; ?>"> -->
                              </div>
                            </td>
                            <?php if(!in_array($ar[0],array("report"))): ?>
                            <td>
                              <div class="v_display display-<?= $mn->MenuID; ?> checkbox checkbox-primary">
                                <input name="tambah[]" id="tambah<?= $mn->MenuID; ?>" type="checkbox" class="cek-add validate" value="<?= $mn->MenuID; ?>">
                                <label for="tambah<?= $mn->MenuID; ?>" style="text-transform: lowercase;">add data</label>
                              </div>
                            </td>
                            <td>
                              <div class="v_display display-<?= $mn->MenuID; ?> checkbox checkbox-primary">
                                <input name="ubah[]" id="ubah<?= $mn->MenuID; ?>" type="checkbox" class="cek-edit validate" value="<?= $mn->MenuID; ?>">
                                <label for="ubah<?= $mn->MenuID; ?>" style="text-transform: lowercase;">edit</label>                      
                              </div>
                            </td>
                            <td>
                              <div class="v_display display-<?= $mn->MenuID; ?> checkbox checkbox-primary">
                                <input name="hapus[]" id="hapus<?= $mn->MenuID; ?>" type="checkbox" class="cek-delete validate" value="<?= $mn->MenuID; ?>">
                                <label for="hapus<?= $mn->MenuID; ?>" style="text-transform: lowercase;">delete</label>                      
                              </div>
                            </td>
                            <!-- <td>
                              <div class="v_display display-<?= $mn->MenuID; ?> checkbox checkbox-primary">
                                <input name="approve[]" id="approve<?= $mn->MenuID; ?>" type="checkbox" class="cek-approve validate" value="<?= $mn->MenuID; ?>">
                                <label for="approve<?= $mn->MenuID; ?>" style="text-transform: lowercase;">approve</label>                      
                              </div>
                            </td> -->
                            <?php endif; ?>
                            <!-- <td>
                            	<div class="v_display display-<?= $mn->MenuID; ?>">                        		
	                              <select name="filter[]" id="filter<?= $mn->MenuID; ?>" class="form-control">
	                                <option value="0"> All Data</option>
	                                <option value="1"> Filter By Company</option>
	                                <option value="2"> Filter By Pegawai</option>
	                              </select>
                            	</div>
                            </td> -->
                            </tr>
                            <?php 
                              endforeach;
                            else:
                              echo '<tr><td colspan="6">Tidak Ada</td></tr>';
                            endif;
                          ?>                  
                          </table>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endforeach; ?>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button type="button" class="btn btn-white margin-0" data-dismiss="modal">Close</button>
                  <button id="btnSave" onclick="save()" type="button" class="btn btn-default">Save</button>
                </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div>
</div>

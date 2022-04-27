<style type="text/css">
  @media only screen and (min-width: 1280px) {
    .banner-content {
      padding: 3rem;
      padding-left: 14px;
      margin-top: -23%;
      position: absolute;
      z-index: 1;
    }
    .fig-summary {
      color: #ffff;
      text-shadow: 2px 2px 5px black;
      display: block;
    }
    .banner {
      /* margin-top: 5rem; */
      height: 100vh;
      /* max-width: 1600px; */
      max-height: 700px;
      margin: auto;
      filter: brightness(0.40);
    }
  }
  @media only screen and (max-width: 480px){
    div.container {
      font-size: 20px;
      padding-left: 0px !important; 
      padding-right: 0px !important; 
      line-height: 35px;
    }
    div.container img{
      max-width: 100% !important;
      min-width: 100% !important;
    }
    div.container p {
      padding-left: 3% !important; 
      padding-right: 3% !important; 
    }
    div.container p img{
      max-width: 100% !important;
      min-width: 100% !important;
    }
    .table-bordered td, .table-bordered th {
      border: 0px;
      display: block;
    }
  }
  .table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 0px; 
  }
  .table-bordered td, .table-bordered th {
    border: 0px;
  }
  .table-bordered {
    border: 0px;
  }
</style>
<?php
  $link = $this->api->get_link_article($data->Namelink,"name");
  $link = site_url($link);
  $link = $this->api->link_whatsapp("text=".$link);
  $alt  = $this->main->alt();
?>
<header class="banner text-white bg-cover" style="background: url('<?= base_url($data->ImageUrl) ?>') top">
  <!-- <div class="overlay"></div> -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
      </div>
    </div>
  </div>
</header>
<div class="banner-content banner-bottom container-fluid">
  <div class="text-left mb-20">
    <div class="border-bottom-blue"></div>
  </div>
  <div class="title text-white ">
    <?= "<b>".$name[0]."</b> ".$name[1] ?>
  </div>
  <div class="fig-summary"><i><?= $data->Summary ?></i></div>
  <div id="js-social-share" class="jssocial"></div>
  <div class="div-link link-white" data-aos="fade-right">
    <ul>
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li class="line-up-white"><span class="visible">i</span></li>
      <li><a href="<?= site_url('article.html'); ?>">Article</a></li>
      <li class="line-up-white"><span class="visible">i</span></li>
      <li><a href="<?= current_url(); ?>"><?= "<b>".$name[0]."</b> ".$name[1] ?></a></li>
      
    </ul>
  </div>
</div>

<div class="varticle-detail">
  <section class="bg-background">
    <div class="container" style="font-size: 20px; padding-left: 60px; padding-right: 60px; line-height: 35px">
      <p><?= $data->Description ?></p>
    </div>
  </section>
</div>
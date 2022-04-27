<!-- Masthead -->
<header class="banner text-white bg-cover" style="background: url('aset/img/banner-blog.jpg') top">
  <!-- <div class="overlay"></div> -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
      </div>
    </div>
  </div>
</header>
<?php $alt = $this->main->alt(); ?>
<div class="banner-content banner-bottom container-fluid page-data" data-page="article">
  <div class="text-left mb-20">
  <div class="section-title aos-init aos-animate" data-aos="fade-down"><?= $this->lang->line('article'); ?></div>
    <div class="border-bottom-blue"></div>
  </div>
  <div class="div-link link-white" data-aos="fade-right">
    <ul>
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li class="line-up-white"><span class="visible">i</span></li>
      <li><a href="<?= current_url(); ?>">Article</a></li>
    </ul>
  </div>
</div>

<!-- partial:index.partial.html -->
<div class="row row-custom">
  <?php foreach($data as $d){
    $link = $this->api->get_link_article($d->Namelink,"name");
    $link = site_url($link);
    if ($d->ImageUrl):
      $Image = base_url($d->ImageUrl);
    else:
      $Image = base_url('aset/img/background/background-article.jpg');
    endif;
  ?> 
  <div class="col-sm-6">
    <div class="blog-slider">
      <div class="blog-slider__wrp swiper-wrapper">
        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img src="<?= $Image ?>" alt="<?= $alt.', '.$d->Name ?>">
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code label-date"><i class="ti-calendar pr-10"></i><?= $d->Date ?></span>
            <div class="blog-slider__title"><i class="ti-pencil-alt pr-10"></i><?= $d->Name ?></div>
            <div class="blog-slider__text trim"><?= $d->Summary ?></div>
            <a href="<?= $link ?>" class="blog-slider__button"><?= $this->lang->line('view_more'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?> 
</div>
<!-- partial -->
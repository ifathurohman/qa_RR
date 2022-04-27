<!-- Masthead -->
  <div id="slideshow">
    <?php 
      $language  = $this->session->bahasa;
      if($language == "indonesia"):
        $slideshow = $this->api->slideshow("list_data");
      else:
        $slideshow = $this->api->slideshow("list_data");
      endif;
    ?>
    <!-- partial:index.partial.html -->
    <main role="main">

      <!-- Slider -->
      <section class="velo-slides" data-velo-slider="on" data-velo-theme="light">

      <?php foreach ($slideshow as $v) { ?>
        <!-- Slide 1-->
        <section class="velo-slide">
          
          <!-- Pretitle Hint -->
          <span class="velo-slider__hint"><span><span>
             <a href="<?= site_url('#newsletter'); ?>" onclick="closeNav('newsletter')" style="color: white;"><?= $this->lang->line('subscribe'); ?>
             </a>
          </span></span></span> 
          <!-- Slide BG -->
          <div class="velo-slide__bg">      
            <!-- Img -->
            <figure class="velo-slide__figure" style="background-image: url(<?= $v->Patch ?>)"></figure>
          </div>
          <!-- Header -->
          <header class="velo-slide__header">
            <h3 class="velo-slide__title">
              <span class="oh">
                <span>
                  <?= $v->Name ?>
                </span>
              </span>
              <!-- <span class="oh">
                <span>
                  <?= $v->Name ?>
                </span>
              </span> -->
            </h3>
            <p class="velo-slide__text">
              <span class="oh">
                <span>
                  <?= $v->Description ?>
                </span>
              </span>
            </p>
            <?php 
              $list_btn = json_decode($v->ButtonLink);
            ?>
            <span class="velo-slide__btn">
                <?php 
                $view_more = $this->lang->line('view_more');
                if(count($list_btn) > 0):
                  foreach ($list_btn as $b):
                    echo 
                    '<a class="btn-draw btn--white" href="'.$b->BtnLink.'">
                      <span class="btn-draw__text">
                        <span>'.$view_more.'</span>
                      </span>
                    </a>';
                  endforeach;
                endif;
                ?>
                <!-- <a class="btn-draw btn-white" href=" <?= $v->BtnLink ?>">
                  <span class="btn-draw__text">
                    <span>View Work</span>
                  </span>
                </a> -->
            </span>
          </header> 
        </section>
      <?php }?>

        <!-- Slides Nav -->
        <nav class="velo-slides-nav">
          <ul class="velo-slides-nav__list">
            <li>
              <a class="js-velo-slides-prev velo-slides-nav__prev inactive" href="#0"><i class="icon-up-arrow"></i></a>
            </li>
            <li>
              <a class="js-velo-slides-next velo-slides-nav__next" href="#"><i class="icon-down-arrow"></i></a>
            </li>
          </ul>
        </nav>
      </section>
    </main>
    <!-- partial -->
  </div>

<section class="buy-report showcase">
  <div class="container-fluid p-0 aos-init aos-animate" data-aos="fade-down">
    <div class="row no-gutters" style="background-image: url('aset/img/home/Rumah singgah ibu hamil - Rumah aman ibu hamil-Home3.jpg');background-size: cover;background-position: left; margin-left: 5%;">
      
      <div class="col-lg-8 my-auto bg-white">
        <div class="div showcase-text">
          <h2 class="section-title"><?= $this->lang->line('home-title'); ?></h2>
          <!-- <div class="border-bottom-blue"></div> -->
          <p class="lead text-section"><?= $this->lang->line('home-txt1'); ?></p>
          <p class="lead text-section"><?= $this->lang->line('home-txt2'); ?></p>
          <p class="lead text-section"><?= $this->lang->line('home-txt3'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <div class="our-solutions text-center" style="min-height: 0px;padding-bottom: 0em;">
    <div class="container">
      <div class="section-title" data-aos="fade-down" style="padding-bottom:20px"><?= $this->lang->line('home-testimony'); ?></div>
   </div>
   <div class="text-center">
    <div class="vid-main-wrapper clearfix">
      <div class="vid-container">
          <iframe width="560" height="100%" src="https://www.youtube.com/embed/b1noCrbhA5w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
</div> -->
  
<!-- partial:index.partial.html -->
<section>
  <div class='content'>
    <div class='slider single-item'>
      <div class='quote-container'>
        <div class='portrait octogon'>
          <!-- <img alt='' src='http://www.tuacahntech.com/uploads/6/1/7/9/6179841/6166205_orig.jpg'> -->
        </div>
        <div class='quote'>
          <img alt=""  src="<?= $this->main->set_('Logo'); ?>" class="logo-custom"/>
          <blockquote>
            <p>
              <?= $this->lang->line('home-testimony1.1-txt'); ?>
              <?= $this->lang->line('home-testimony1.2-txt'); ?>
              <?= $this->lang->line('home-testimony1.3-txt'); ?>
            </p>
            <cite>
              <span></span>
              <br><br>
            </cite>
          </blockquote>
        </div>
      </div>
      <div class='quote-container'>
        <div class='portrait octogon'>
          <!-- <img alt='' src='http://www.tuacahntech.com/uploads/6/1/7/9/6179841/6166205_orig.jpg'> -->
        </div>
        <div class='quote'>
          <img alt=""  src="<?= $this->main->set_('Logo'); ?>" class="logo-custom"/>
          <blockquote>
            <p>
              <?= $this->lang->line('home-testimony2.1-txt'); ?>
              <?= $this->lang->line('home-testimony2.2-txt'); ?>
              <?= $this->lang->line('home-testimony2.3-txt'); ?>
            </p>
            <cite>
              <span></span>
              <br><br>
            </cite>
          </blockquote>
        </div>
      </div>
      <div class='quote-container'>
        <div class='portrait octogon'>
          <!-- <img alt='' src='http://www.tuacahntech.com/uploads/6/1/7/9/6179841/6166205_orig.jpg'> -->
        </div>
        <div class='quote'>
          <img alt=""  src="<?= $this->main->set_('Logo'); ?>" class="logo-custom"/>
          <blockquote>
            <p>
              <?= $this->lang->line('home-testimony3.1-txt'); ?>
              <?= $this->lang->line('home-testimony3.2-txt'); ?>
              <?= $this->lang->line('home-testimony3.3-txt'); ?>
            </p>
            <cite>
              <span></span>
              <br><br>
            </cite>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- partial -->
<section id="newsletter">
  <section class="showcase about-us-section" data-aos="fade-right">
      <div class="container-fluid p-0 ">
        <div class="row no-gutters" style="background-image: url('aset/img/home/Rumah singgah ibu hamil - Rumah aman ibu hamil-Home2.jpg');background-size: cover;background-position: center;">
          <div class="col-lg-6 text-white showcase-img div-sub-top">

          </div>
          <div class="col-lg-5 my-auto bg-white box-shadow-lr" data-aos="fade-right">
            <div class="div showcase-text">
              <h2 class="section-title" style="padding-bottom: 75px;"><?= $this->lang->line('newsletter'); ?>
                <div class="border-bottom-blue"></div>
              </h2>
               <?php $this->load->view('frontend/form/subscriber'); ?>
            </div>
           <!--  <div class="div-btn">
              <a href="<?= site_url('blog'); ?>" class="btn btn-blue p-r-5"><span class="label-btn">READ OUR BLOG</span> <span class="icon-btn"><i class="fa fa-arrow-right"></i></span></a>
              <a href="<?= site_url('faq'); ?>" class="btn btn-link">READ FAQS</a>
            </div> -->
          </div>
        </div>
      </div>
  </section>
</section>

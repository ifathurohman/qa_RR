<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/photoswipe.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/default-skin/default-skin.css'>

<!-- partial:index.partial.html -->
<main class="gallery-wrapper"> 
  <div class="container"> 
    <h1 class="gallery-title">Gallery</h1>

    <section class="gallery -main" data-pswp-uid="1">
    <?php foreach ($slideshow as $kk => $v) {
        $Image          = base_url($v->ImageUrl);
        $ImageUrlCrop   = base_url($v->ImageUrlCrop);
        // echo '<li><img src="'.$Image.'" ></li>';
    ?>

      <a class="gallery__item" href="<?= $v->ImageUrl ?>" data-size="600x600" data-author="Rumah RUTH">
        <img src="<?= $v->ImageUrl ?>" class="img-responsive">
        <!-- <figure class="gallery__figure">
          <figcaption class="gallery__figcaption">Kamar tidur</figcaption>
        </figure> -->
      </a>
    <?php } ?> 
    </section><!-- /.gallery -->
  </div><!-- /.container -->
</main><!-- /.gallery-wrapper -->
   
   
        
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!-- partial -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/photoswipe.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/photoswipe-ui-default.min.js'></script>

<style type="text/css">
  @import url("https://fonts.googleapis.com/css?family=Lato:300,400,500,700,900&display=swap");
::-moz-selection {
  background: #333;
  color: #fff;
}
::selection {
  background: #333;
  color: #fff;
}

.img-responsive {
  display: block;
  height: auto;
  width: 100%;
}
.gallery__item .img-responsive {
  height: 100%;
  -o-object-fit: cover;
     object-fit: cover;
  transition: all .5s ease-in;
}

.container {
  margin: 0 auto;
  width: 90%;
}
@media (min-width: 480px) {
  .container {
    width: 400px;
  }
}
@media (min-width: 768px) {
  .container {
    width: 688px;
  }
}
@media (min-width: 1024px) {
  .container {
    width: 944px;
  }
}
@media (min-width: 1274px) {
  .container {
    width: 1194px;
  }
}

.gallery-wrapper {
  padding: 2.5rem 0;
  position: relative;
  overflow: hidden;
}

.gallery-title small {
  display: block;
  font-size: 0.75rem;
  font-weight: 900;
}
@media (min-width: 768px) {
  .gallery-title {
    text-align: center;
  }
}

.gallery-intro {
  font-family: "Times", Sans-Serif, sans-serif;
  margin-bottom: 1.875rem;
}
@media (min-width: 768px) {
  .gallery-intro {
    margin: 0 auto 3.75rem;
    max-width: 600px;
    text-align: center;
  }
}

.gallery {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 0.4166666667rem;
}
.gallery:not(:first-child) {
  margin-top: 0.4166666667rem;
}
@media (min-width: 768px) {
  .gallery {
    grid-template-columns: repeat(4, 1fr);
  }
}
.gallery.-more {
  display: none;
}
.gallery.-block {
  display: grid;
}

.gallery__item {
  background-color: #333;
  color: #fff;
  cursor: pointer;
  display: flex;
  position: relative;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.show-ar .gallery__item:before {
  background-color: rgba(51, 51, 51, 0.75);
  content: '1:1';
  display: flex;
  font-size: 1.5rem;
  align-items: center;
  justify-content: center;
  position: absolute;
  height: 100%;
  width: 100%;
}
.gallery__item:nth-child(13n + 1) {
  grid-column: 1 / -1;
}
.show-ar .gallery__item:nth-child(13n + 1):before {
  content: '2:3';
}
@media (min-width: 768px) {
  .gallery__item:nth-child(13n + 1) {
    grid-column: 1 / span 2;
    grid-row: 1 / span 3;
  }
}
.gallery__item:nth-child(13n + 8) {
  grid-column: 1 / -1;
}
.show-ar .gallery__item:nth-child(13n + 8):before {
  content: '4:2';
}
.gallery__item:nth-child(13n + 13) {
  grid-column: 1 / -1;
}
.show-ar .gallery__item:nth-child(13n + 13):before {
  content: '2:2';
}
@media (min-width: 768px) {
  .gallery__item:nth-child(13n + 13) {
    grid-column: 3 / span 2;
    grid-row: 5 / span 2;
  }
}
.-absolute .gallery__item {
  position: relative;
}

.gallery__figure {
  display: none;
}

.modal {
  background-color: rgba(0, 0, 0, 0.75);
  display: none;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}
.modal.-open {
  display: flex;
}

.modal__content {
  align-items: center;
  cursor: pointer;
  display: flex;
  overflow: hidden;
  margin: 0 auto;
  min-height: 100vh;
  position: relative;
  padding: 3.75rem 2.5rem;
  width: 50%;
}

.modal__slider {
  position: absolute;
}
.modal__slider:after {
  content: "";
  display: table;
  clear: both;
}

.modal__figure {
  float: left;
  margin: 0;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
@media (min-width: 1024px) {
  .modal__figure {
    align-items: flex-end;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }
}

@media (min-width: 1024px) {
  .modal__img {
    width: 60%;
  }
}

.modal__figcaption {
  color: #e1e1e1;
  font-size: 0.85rem;
  margin-top: 0.625rem;
}
@media (min-width: 1024px) {
  .modal__figcaption {
    width: 35%;
  }
}

.modal__link {
  color: #e1e1e1;
  display: block;
  font-size: 1rem;
  margin-top: 1.25rem;
  text-decoration: none;
  transition: color .5s ease-in;
}
.modal__link:after {
  font-family: FontAwesome;
  content: '\f054';
  display: inline-block;
  font-size: 0.75rem;
  margin-left: 1.25rem;
  text-decoration: none;
}
.modal__link:hover {
  color: #fff;
}

.modal__btn {
  background: none;
  border: none;
  color: #e1e1e1;
  cursor: pointer;
  transition: all .25s ease-in;
}
@media (min-width: 1024px) {
  .modal__btn {
    font-size: 2rem;
  }
}
.modal__btn.-close {
  position: absolute;
  top: 1.25rem;
  right: 1.25rem;
}
.modal__btn.-close:hover {
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}
.modal__btn.-left, .modal__btn.-right {
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  z-index: 1000;
}
.modal__btn.-left:hover, .modal__btn.-right:hover {
  -webkit-transform: translateY(-50%) scale(1.1);
          transform: translateY(-50%) scale(1.1);
}
.modal__btn.-left {
  left: 1.25rem;
}
.modal__btn.-right {
  right: 1.25rem;
}

</style>
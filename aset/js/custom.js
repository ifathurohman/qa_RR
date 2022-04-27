// author muhammad iqbal ramadhan
// kalau mau tanya silahkan
// IG : iqbal_raamadhan
// telp: 089621882292
// email : iqbalzt.ramadhan@gmail.com
// job : web programmer dan android programmer  

var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
var host        = window.location.origin+'/';
var url = window.location.href;
var index_page;
var id_page;
var modul_page;
$(document).ready(function() {
	dt 			= $(".page-data").data();
	dt2 		= $(".data-page").data();
	index_page 	= dt.index;
	if(dt2){
		modul_page  = dt2.modul;
		id_page 	= dt2.id;
	}
	if(window.location.hash) {
	 	goToByScroll(window.location.hash);
	}
   link_about_us();
   init_page();
   AOS.init();
});
function link_about_us(){
	if($("div,ul").hasClass("abous-us-list-contact")){
		list = $(".abous-us-list-contact li a");
		$.each(list,function(i,v){
			if(i == 0){
				dt = $(v).data();
				$(".buy-report-right .section-title").text($(v).text());
				$(".buy-report-right .text-section").text(dt.desc);
				if(dt.email){
					$(".buy-report-right .email").html("Email : <a href='mailto:"+dt.email+"' class='red bold' target='_blank'>"+dt.email+'</a>');
				} else {
					$(".buy-report-right .email").html("");
				}
				$(".buy-report-right .link").attr("href",dt.url);
				if(dt.contact){
					if(dt.contact.length > 0){
						item_contact = '<table>';
						$.each(dt.contact,function(i,v){
							item_contact += '<tr><td>'+v.Name+'</td><td>   : <a href="https://api.whatsapp.com/send?phone='+v.No+'" class="red bold" target="_blank">+'+v.No+'</a></td></tr>';
						});
						item_contact += '</table>';
						$(".buy-report-right .contact").html(item_contact);
					}
				} else {
					$(".buy-report-right .contact").html("");
				}
			}
		});
	}


	$(".buy-report .ul-section a").click(function(){
		a 	= $(this);
		dt 	= a.data();
		$(".buy-report .ul-section a").removeClass("active");
		$(this).addClass("active");
		$(".buy-report-right .section-title").text(a.text());
		$(".buy-report-right .text-section").text(dt.desc);
		if(dt.email){
			$(".buy-report-right .email").html("Email : <a href='mailto:"+dt.email+"' class='red bold' target='_blank'>"+dt.email+'</a>');
		} else {
			$(".buy-report-right .email").html("");
		}
		$(".buy-report-right .link").attr("href",dt.url);
		if(dt.contact){
			if(dt.contact.length > 0){
				item_contact = '<table>';
				$.each(dt.contact,function(i,v){
					item_contact += '<tr><td>'+v.Name+'</td><td>   : <a href="https://api.whatsapp.com/send?phone='+v.No+'" class="red bold" target="_blank">+'+v.No+'</a></td></tr>';
				});
				item_contact += '</table>';
				$(".buy-report-right .contact").html(item_contact);
			}
		} else {
			$(".buy-report-right .contact").html("");
		}
	});
	$(".buy-report .ul-section a").hover(function(){
		a 	= $(this);
		dt 	= a.data();
		$(".buy-report .ul-section a").removeClass("active");
		$(this).addClass("active");
		$(".buy-report-right .section-title").text(a.text());
		$(".buy-report-right .text-section").text(dt.desc);
		if(dt.email){
			$(".buy-report-right .email").html("Email : <a href='mailto:"+dt.email+"' class='red bold' target='_blank'>"+dt.email+'</a>');
		} else {
			$(".buy-report-right .email").html("");
		}
		$(".buy-report-right .link").attr("href",dt.url);
		if(dt.contact){
			if(dt.contact.length > 0){
				item_contact = '<table>';
				$.each(dt.contact,function(i,v){
					item_contact += '<tr><td>'+v.Name+'</td><td>   : <a href="https://api.whatsapp.com/send?phone='+v.No+'" class="red bold" target="_blank">+'+v.No+'</a></td></tr>';
				});
				item_contact += '</table>';
				$(".buy-report-right .contact").html(item_contact);
			}
		} else {
			$(".buy-report-right .contact").html("");
		}
	});

	$(".dropdown-toggle").click(function(){
		$.each($(".row-dropdown .dropdown-content"),function(i,v){
			if(i == 0){
				$(v).addClass("active");
			}
		});
	});
	$(".row-dropdown .dropdown-main a").hover(function(){
		a 	= $(this);
		dt 	= a.data();
		obj = a[0];
		$(".dropdown-content").removeClass("active");
	});

	if(mobile){
		$(".nav-search").css("width","100%");
	} else {
		if(index_page == "frontend"){    
		  $(".navbar-menu-atas .dropdown-mega a").removeClass("dropdown-toggle");
		  $(".navbar-menu-atas .dropdown-mega a").attr("data-toggle","");
		  $('.navbar-menu-atas .dropdown, .navbar-menu-atas .dropdown-menu, .nav-item.dropdown').hover(
		       function(){ $(this).addClass('show'); $(".nav-item .dropdown-menu").addClass("show"); },
		       function(){ $(this).removeClass('show'); $(".nav-item .dropdown-menu").removeClass('show'); }
		  );
		}
	}



	if($("div").hasClass("list-experience")){
		GetListExperience('index');
	}
	if($("div").hasClass("jssocial")){
		init_jssocial();
	}
}
function init_jssocial(){
	$("#js-social-share").jsSocials({
	    // shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
	    shareIn: "popup",
	    shares: ["twitter", "facebook", "whatsapp","email","telegram"]
	});
}


var TotalData = 0;
var Start 	  = 0;
var Limit 	  = 0;
var ix 		  = 0;
function GetListExperience(Modul){
	data_post = [];
	if(Modul == "load"){
		data_post = {
			Start : Start,
			Limit : Limit,
		}
	}
	$.ajax({
        url : host + 'api/experience_list',
        type: "POST",
        data : data_post,
        dataType: "JSON",
        success: function(json){
        	if(json){
        		Start 	  = parseInt(json.Start) + parseInt(json.Limit);
        		Limit 	  = json.Limit;
        		TotalData += json.ListData.length;
        		if(json.ListData && json.ListData.length > 0){
        			if(Modul == "index"){
        				$(".section-experience").show();
        			}
        			$.each(json.ListData,function(i,v){
        				col = 'col-sm-8';
        				if(ix % 3){
		                  col = "col-sm-4";
		                  if(ix  == 4 || ix == 7 || ix == 8){
		                    col = "col-sm-8";
		                  }
		                }
		                if(ix  == 6 || ix == 9){
		                  col = "col-sm-4";
		                }
		               	ix = ix + 1;
		               	if(ix == 10){
		               		ix  = 2;
		               	}
        				item = '<div class="'+col+' aos-init pointer" data-aos="fade-right">\
		                  <a href="'+v.Link+'" target="_blank">\
		                    <div class="item">\
		                      <img src="'+v.Image+'" class="img">\
		                      <div class="middle">\
		                        <div class="text">'+v.Name+'</div>\
		                      </div>\
		                    </div>\
		                  </a>\
		                </div>';
        				$(".list-experience").append(item);
        			});
        		}
        		if(TotalData == json.TotalData){
        			$(".btn-list-experience").hide();
        		} else {
        			$(".btn-list-experience").show();
        		}
        	}
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR.responseText);
        }
    });
}
function goToByScroll(id){
	if(mobile){
	    $('html,body').animate({scrollTop: $(id).offset().top - 50},'slow');
	} else {
	    $('html,body').animate({scrollTop: $(id).offset().top - 50},'slow');
	}
}
$(function(){
    var current = location.pathname;
    $('.navbar-nav li a').each(function(){
        var $this = $(this);
        // console.log($this.attr('href'));
        // if the current path is like this link, make it active
        // if($this.attr('href').indexOf(current) !== -1){
        if($this.attr('href') == url){
            $this.addClass('active');
        }
    });

    $(".side-menu .list-link a").each(function(){
        var $this = $(this);
        if($this.attr('href') == url){
            $this.parent().parent().parent().addClass('show');
        }
    });
});

function init_page(){
	if(modul_page == "list-product"){
		choose_category(id_page,'index');
	}
}

function choose_category(e,modul){
	$(".loading-item").show();
	$(".list-product-data").empty();
	if(modul == "index"){
		CategoryID = e;
	} else {
		$(".list-category .item").removeClass("active");
		$(e).children().addClass("active");
		dt = $(e).data();
		CategoryID = dt.id;
		window.history.pushState('page2', 'Title', host+'product/list/'+CategoryID);
	}

	$.ajax({
        url : host + "api/product_list/"+CategoryID,
        type: "POST",
        dataType: "JSON",
        data: '',
        success: function(json){
          if(json.Status){
          	$.each(json.ListData,function(i,v){
	          	item = '<div class="col-sm-6 col-xs-6 aos-init" data-aos="fade-down">\
					<a href="'+v.Link+'">\
						<div class="item">\
							<div class="left">\
								<p class="title">'+v.Name+'</p>\
								<p class="text">'+v.Summary+'</p>\
								<button class="btn btn-white link-more">Learn More</button>\
							</div>\
							<div class="right">\
								<img src="'+v.Image+'" class="img" title="'+v.Name+'">\
							</div>\
						</div>\
					</a>\
				</div>';
				$(".list-product-data").append(item);
          	});

          } else {
          	item = '<div class="col-sm-12 aos-init" data-aos="fade-down">\
          		<div class="empty">\
          			<img scr="'+host+'aset/img/not-found.png" class="img">\
          			<p class="title">Oops, product not found :( </p>\
					<p class="text">No result found. Try another category?</p>\
          		</div>\
          	</div>'; 
			$(".list-product-data").append(item);

          }
	  	  $(".loading-item").hide();
        },
        error: function (jqXHR, textStatus, errorThrown){
            console.log(jqXHR.responseText);
        }
    });
}
$(window).scroll(function() {
  if ($(this).scrollTop() > 0) {
    $('.velo-slides-nav').fadeOut();
  } else {
    $('.velo-slides-nav').fadeIn();
  }
  if ($(this).scrollTop() < 1) {
    $('.velo-slider__hint').fadeOut();
  } else {
    $('.velo-slider__hint').fadeIn();
  }
});
//navbar
function closeNav(page) {
	open = false;
	if (page == "vision_mission" || page == 'history' || page == 'halfway_house'|| page == 'ilumination' || page == 'counseling' || page == 'home') {
		$('header, body').animate({
			scrollTop: $("#" + page).offset().top - 100
		}, 3000);
	}
}
document.addEventListener('click', closeNav);
//navbar

// galery
(function () {

  var initPhotoSwipeFromDOM = function (gallerySelector) {

    var parseThumbnailElements = function (el) {
      var thumbElements = el.childNodes,
      numNodes = thumbElements.length,
      items = [],
      el,
      childElements,
      thumbnailEl,
      size,
      item;

      for (var i = 0; i < numNodes; i++) {
        el = thumbElements[i];

        // include only element nodes 
        if (el.nodeType !== 1) {
          continue;
        }

        childElements = el.children;

        size = el.getAttribute('data-size').split('x');

        // create slide object
        item = {
          src: el.getAttribute('href'),
          w: parseInt(size[0], 10),
          h: parseInt(size[1], 10),
          author: el.getAttribute('data-author'),
          title: el.getAttribute('data-title') };


        item.el = el; // save link to element for getThumbBoundsFn

        if (childElements.length > 0) {
          item.msrc = childElements[0].getAttribute('src'); // thumbnail url
          if (childElements.length > 1) {
            item.title = childElements[1].innerHTML; // caption (contents of figure)
          }
        }


        var mediumSrc = el.getAttribute('data-med');
        if (mediumSrc) {
          size = el.getAttribute('data-med-size').split('x');
          // "medium-sized" image
          item.m = {
            src: mediumSrc,
            w: parseInt(size[0], 10),
            h: parseInt(size[1], 10) };

        }
        // original image
        item.o = {
          src: item.src,
          w: item.w,
          h: item.h };


        items.push(item);
      }

      return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
      return el && (fn(el) ? el : closest(el.parentNode, fn));
    };

    var onThumbnailsClick = function (e) {
      e = e || window.event;
      e.preventDefault ? e.preventDefault() : e.returnValue = false;

      var eTarget = e.target || e.srcElement;

      var clickedListItem = closest(eTarget, function (el) {
        return el.tagName === 'A';
      });

      if (!clickedListItem) {
        return;
      }

      var clickedGallery = clickedListItem.parentNode;

      var childNodes = clickedListItem.parentNode.childNodes,
      numChildNodes = childNodes.length,
      nodeIndex = 0,
      index;

      for (var i = 0; i < numChildNodes; i++) {
        if (childNodes[i].nodeType !== 1) {
          continue;
        }

        if (childNodes[i] === clickedListItem) {
          index = nodeIndex;
          break;
        }
        nodeIndex++;
      }

      if (index >= 0) {
        openPhotoSwipe(index, clickedGallery);
      }
      return false;
    };

    var photoswipeParseHash = function () {
      var hash = window.location.hash.substring(1),
      params = {};

      if (hash.length < 5) {// pid=1
        return params;
      }

      var vars = hash.split('&');
      for (var i = 0; i < vars.length; i++) {
        if (!vars[i]) {
          continue;
        }
        var pair = vars[i].split('=');
        if (pair.length < 2) {
          continue;
        }
        params[pair[0]] = pair[1];
      }

      if (params.gid) {
        params.gid = parseInt(params.gid, 10);
      }

      return params;
    };

    var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
      var pswpElement = document.querySelectorAll('.pswp')[0],
      gallery,
      options,
      items;

      items = parseThumbnailElements(galleryElement);

      // define options (if needed)
      options = {

        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

        getThumbBoundsFn: function (index) {
          // See Options->getThumbBoundsFn section of docs for more info
          var thumbnail = items[index].el.children[0],
          pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
          rect = thumbnail.getBoundingClientRect();

          return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
        },

        addCaptionHTMLFn: function (item, captionEl, isFake) {
          if (!item.title) {
            captionEl.children[0].innerText = '';
            return false;
          }
          captionEl.children[0].innerHTML = item.title + '<br/><small>Photo: ' + item.author + '</small>';
          return true;
        } };




      if (fromURL) {
        if (options.galleryPIDs) {
          // parse real index when custom PIDs are used 
          // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
          for (var j = 0; j < items.length; j++) {
            if (items[j].pid == index) {
              options.index = j;
              break;
            }
          }
        } else {
          options.index = parseInt(index, 10) - 1;
        }
      } else {
        options.index = parseInt(index, 10);
      }

      // exit if index not found
      if (isNaN(options.index)) {
        return;
      }



      var radios = document.getElementsByName('gallery-style');
      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          if (radios[i].id == 'radio-all-controls') {

          } else if (radios[i].id == 'radio-minimal-black') {
            options.mainClass = 'pswp--minimal--dark';
            options.barsSize = { top: 0, bottom: 0 };
            options.captionEl = false;
            options.fullscreenEl = false;
            options.shareEl = false;
            options.bgOpacity = 0.85;
            options.tapToClose = true;
            options.tapToToggleControls = false;
          }
          break;
        }
      }

      if (disableAnimation) {
        options.showAnimationDuration = 0;
      }

      // Pass data to PhotoSwipe and initialize it
      gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

      // see: http://photoswipe.com/documentation/responsive-images.html
      var realViewportWidth,
      useLargeImages = false,
      firstResize = true,
      imageSrcWillChange;

      gallery.listen('beforeResize', function () {

        var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
        dpiRatio = Math.min(dpiRatio, 2.5);
        realViewportWidth = gallery.viewportSize.x * dpiRatio;


        if (realViewportWidth >= 1200 || !gallery.likelyTouchDevice && realViewportWidth > 800 || screen.width > 1200) {
          if (!useLargeImages) {
            useLargeImages = true;
            imageSrcWillChange = true;
          }

        } else {
          if (useLargeImages) {
            useLargeImages = false;
            imageSrcWillChange = true;
          }
        }

        if (imageSrcWillChange && !firstResize) {
          gallery.invalidateCurrItems();
        }

        if (firstResize) {
          firstResize = false;
        }

        imageSrcWillChange = false;

      });

      gallery.listen('gettingData', function (index, item) {
        if (useLargeImages) {
          item.src = item.o.src;
          item.w = item.o.w;
          item.h = item.o.h;
        } else {
          item.src = item.m.src;
          item.w = item.m.w;
          item.h = item.m.h;
        }
      });

      gallery.init();
    };

    // select all gallery elements
    var galleryElements = document.querySelectorAll(gallerySelector);
    console.log(gallerySelector);
    for (var i = 0, l = galleryElements.length; i < l; i++) {
      galleryElements[i].setAttribute('data-pswp-uid', i + 1);
      galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if (hashData.pid && hashData.gid) {
      openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
    }
  };

  initPhotoSwipeFromDOM('.gallery');

})();
// galery
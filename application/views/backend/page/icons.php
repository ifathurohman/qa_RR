<script type="text/javascript">
    $(document).ready(function() {
      $(".demo-icons-list li").hover(function(i,v){
        icon = $(this).data('clipboard-text');
          $("#icon-selected").html(icon);
        }, function(){
          $("#icon-selected").html('Click an icon to copy the class name');
      });
      $(".demo-icons-list li").click(function(i,v){
          icon = $(this).data('clipboard-text');
          copyStringToClipboard(icon);

          $("#icon-selected").html(icon + ' - <i>copied</i>');
          toastr.success(icon + ' - <i>copied</i>',"Information");


      });
    });
    function copyStringToClipboard (str) {
       // Create new element
       var el = document.createElement('textarea');
       // Set value (string to be copied)
       el.value = str;
       // Set non-editable to avoid focus and move outside of view
       el.setAttribute('readonly', '');
       el.style = {position: 'absolute', left: '-9999px'};
       document.body.appendChild(el);
       // Select text inside element
       el.select();
       // Copy text to clipboard
       document.execCommand('copy');
       // Remove temporary element
       document.body.removeChild(el);
    }
</script>
<div class="main-content">
    <div class="card">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1">THEMIFY</a></li>
            <li><a data-toggle="tab" href="#tab-2">FONT AWESOME</a></li>
        </ul>

        <header class="bg-white" data-provide="sticker" data-target="next" data-original-top="443" style="left: 290px; width: 1103px; top: 64px;">
            <div class="flexbox p-20">
                <div class="flex-grow pl-1 lead text-center text-secondary" id="icon-selected">Click an icon to copy the class name</div>
            </div>
            <ul class="nav nav-tabs nav-justified mb-0 lead" id="icon-tabs">
                <li class="nav-item d-none">
                    <a class="nav-link" data-toggle="tab" href="#tab-search-result"></a>
                </li>
            </ul>
        </header>
        <div class="card-body tab-content" style="background-color: rgb(254, 254, 255); margin-top: 0px;">
            <div class="tab-pane fade" id="tab-search-result">
                <ul class="demo-icons-list icons-size-24px"></ul>
            </div>
            <div id="tab-1" class="tab-pane fade in active">
                <ul class="demo-icons-list icons-size-24px">
                    <li data-clipboard-text="ti-wand">
                        <span class="ti-wand"></span>
                    </li>
                    <li data-clipboard-text="ti-save">
                        <span class="ti-save"></span>
                    </li>
                    <li data-clipboard-text="ti-save-alt">
                        <span class="ti-save-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-direction">
                        <span class="ti-direction"></span>
                    </li>
                    <li data-clipboard-text="ti-direction-alt">
                        <span class="ti-direction-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-user">
                        <span class="ti-user"></span>
                    </li>
                    <li data-clipboard-text="ti-link">
                        <span class="ti-link"></span>
                    </li>
                    <li data-clipboard-text="ti-unlink">
                        <span class="ti-unlink"></span>
                    </li>
                    <li data-clipboard-text="ti-trash">
                        <span class="ti-trash"></span>
                    </li>
                    <li data-clipboard-text="ti-target">
                        <span class="ti-target"></span>
                    </li>
                    <li data-clipboard-text="ti-tag">
                        <span class="ti-tag"></span>
                    </li>
                    <li data-clipboard-text="ti-desktop">
                        <span class="ti-desktop"></span>
                    </li>
                    <li data-clipboard-text="ti-tablet">
                        <span class="ti-tablet"></span>
                    </li>
                    <li data-clipboard-text="ti-mobile">
                        <span class="ti-mobile"></span>
                    </li>
                    <li data-clipboard-text="ti-email">
                        <span class="ti-email"></span>
                    </li>
                    <li data-clipboard-text="ti-star">
                        <span class="ti-star"></span>
                    </li>
                    <li data-clipboard-text="ti-spray">
                        <span class="ti-spray"></span>
                    </li>
                    <li data-clipboard-text="ti-signal">
                        <span class="ti-signal"></span>
                    </li>
                    <li data-clipboard-text="ti-shopping-cart">
                        <span class="ti-shopping-cart"></span>
                    </li>
                    <li data-clipboard-text="ti-shopping-cart-full">
                        <span class="ti-shopping-cart-full"></span>
                    </li>
                    <li data-clipboard-text="ti-settings">
                        <span class="ti-settings"></span>
                    </li>
                    <li data-clipboard-text="ti-search">
                        <span class="ti-search"></span>
                    </li>
                    <li data-clipboard-text="ti-zoom-in">
                        <span class="ti-zoom-in"></span>
                    </li>
                    <li data-clipboard-text="ti-zoom-out">
                        <span class="ti-zoom-out"></span>
                    </li>
                    <li data-clipboard-text="ti-cut">
                        <span class="ti-cut"></span>
                    </li>
                    <li data-clipboard-text="ti-ruler">
                        <span class="ti-ruler"></span>
                    </li>
                    <li data-clipboard-text="ti-ruler-alt-2">
                        <span class="ti-ruler-alt-2"></span>
                    </li>
                    <li data-clipboard-text="ti-ruler-pencil">
                        <span class="ti-ruler-pencil"></span>
                    </li>
                    <li data-clipboard-text="ti-ruler-alt">
                        <span class="ti-ruler-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-bookmark">
                        <span class="ti-bookmark"></span>
                    </li>
                    <li data-clipboard-text="ti-bookmark-alt">
                        <span class="ti-bookmark-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-reload">
                        <span class="ti-reload"></span>
                    </li>
                    <li data-clipboard-text="ti-plus">
                        <span class="ti-plus"></span>
                    </li>
                    <li data-clipboard-text="ti-minus">
                        <span class="ti-minus"></span>
                    </li>
                    <li data-clipboard-text="ti-close">
                        <span class="ti-close"></span>
                    </li>
                    <li data-clipboard-text="ti-pin">
                        <span class="ti-pin"></span>
                    </li>
                    <li data-clipboard-text="ti-pencil">
                        <span class="ti-pencil"></span>
                    </li>

                    <li data-clipboard-text="ti-pencil-alt">
                        <span class="ti-pencil-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-paint-roller">
                        <span class="ti-paint-roller"></span>
                    </li>
                    <li data-clipboard-text="ti-paint-bucket">
                        <span class="ti-paint-bucket"></span>
                    </li>
                    <li data-clipboard-text="ti-na">
                        <span class="ti-na"></span>
                    </li>
                    <li data-clipboard-text="ti-medall">
                        <span class="ti-medall"></span>
                    </li>
                    <li data-clipboard-text="ti-medall-alt">
                        <span class="ti-medall-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-marker">
                        <span class="ti-marker"></span>
                    </li>
                    <li data-clipboard-text="ti-marker-alt">
                        <span class="ti-marker-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-lock">
                        <span class="ti-lock"></span>
                    </li>
                    <li data-clipboard-text="ti-unlock">
                        <span class="ti-unlock"></span>
                    </li>
                    <li data-clipboard-text="ti-location-arrow">
                        <span class="ti-location-arrow"></span>
                    </li>
                    <li data-clipboard-text="ti-layout">
                        <span class="ti-layout"></span>
                    </li>
                    <li data-clipboard-text="ti-layers">
                        <span class="ti-layers"></span>
                    </li>
                    <li data-clipboard-text="ti-layers-alt">
                        <span class="ti-layers-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-key">
                        <span class="ti-key"></span>
                    </li>
                    <li data-clipboard-text="ti-image">
                        <span class="ti-image"></span>
                    </li>
                    <li data-clipboard-text="ti-heart">
                        <span class="ti-heart"></span>
                    </li>
                    <li data-clipboard-text="ti-heart-broken">
                        <span class="ti-heart-broken"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-stop">
                        <span class="ti-hand-stop"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-open">
                        <span class="ti-hand-open"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-drag">
                        <span class="ti-hand-drag"></span>
                    </li>
                    <li data-clipboard-text="ti-flag">
                        <span class="ti-flag"></span>
                    </li>
                    <li data-clipboard-text="ti-flag-alt">
                        <span class="ti-flag-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-flag-alt-2">
                        <span class="ti-flag-alt-2"></span>
                    </li>
                    <li data-clipboard-text="ti-eye">
                        <span class="ti-eye"></span>
                    </li>
                    <li data-clipboard-text="ti-import">
                        <span class="ti-import"></span>
                    </li>
                    <li data-clipboard-text="ti-export">
                        <span class="ti-export"></span>
                    </li>
                    <li data-clipboard-text="ti-cup">
                        <span class="ti-cup"></span>
                    </li>
                    <li data-clipboard-text="ti-crown">
                        <span class="ti-crown"></span>
                    </li>
                    <li data-clipboard-text="ti-comments">
                        <span class="ti-comments"></span>
                    </li>
                    <li data-clipboard-text="ti-comment">
                        <span class="ti-comment"></span>
                    </li>
                    <li data-clipboard-text="ti-comment-alt">
                        <span class="ti-comment-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-thought">
                        <span class="ti-thought"></span>
                    </li>
                    <li data-clipboard-text="ti-clip">
                        <span class="ti-clip"></span>
                    </li>

                    <li data-clipboard-text="ti-check">
                        <span class="ti-check"></span>
                    </li>
                    <li data-clipboard-text="ti-check-box">
                        <span class="ti-check-box"></span>
                    </li>
                    <li data-clipboard-text="ti-camera">
                        <span class="ti-camera"></span>
                    </li>
                    <li data-clipboard-text="ti-announcement">
                        <span class="ti-announcement"></span>
                    </li>
                    <li data-clipboard-text="ti-brush">
                        <span class="ti-brush"></span>
                    </li>
                    <li data-clipboard-text="ti-brush-alt">
                        <span class="ti-brush-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-palette">
                        <span class="ti-palette"></span>
                    </li>
                    <li data-clipboard-text="ti-briefcase">
                        <span class="ti-briefcase"></span>
                    </li>
                    <li data-clipboard-text="ti-bolt">
                        <span class="ti-bolt"></span>
                    </li>
                    <li data-clipboard-text="ti-bolt-alt">
                        <span class="ti-bolt-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-blackboard">
                        <span class="ti-blackboard"></span>
                    </li>
                    <li data-clipboard-text="ti-bag">
                        <span class="ti-bag"></span>
                    </li>
                    <li data-clipboard-text="ti-world">
                        <span class="ti-world"></span>
                    </li>
                    <li data-clipboard-text="ti-wheelchair">
                        <span class="ti-wheelchair"></span>
                    </li>
                    <li data-clipboard-text="ti-car">
                        <span class="ti-car"></span>
                    </li>
                    <li data-clipboard-text="ti-truck">
                        <span class="ti-truck"></span>
                    </li>
                    <li data-clipboard-text="ti-timer">
                        <span class="ti-timer"></span>
                    </li>
                    <li data-clipboard-text="ti-ticket">
                        <span class="ti-ticket"></span>
                    </li>
                    <li data-clipboard-text="ti-thumb-up">
                        <span class="ti-thumb-up"></span>
                    </li>
                    <li data-clipboard-text="ti-thumb-down">
                        <span class="ti-thumb-down"></span>
                    </li>

                    <li data-clipboard-text="ti-stats-up">
                        <span class="ti-stats-up"></span>
                    </li>
                    <li data-clipboard-text="ti-stats-down">
                        <span class="ti-stats-down"></span>
                    </li>
                    <li data-clipboard-text="ti-shine">
                        <span class="ti-shine"></span>
                    </li>
                    <li data-clipboard-text="ti-shift-right">
                        <span class="ti-shift-right"></span>
                    </li>
                    <li data-clipboard-text="ti-shift-left">
                        <span class="ti-shift-left"></span>
                    </li>

                    <li data-clipboard-text="ti-shift-right-alt">
                        <span class="ti-shift-right-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-shift-left-alt">
                        <span class="ti-shift-left-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-shield">
                        <span class="ti-shield"></span>
                    </li>
                    <li data-clipboard-text="ti-notepad">
                        <span class="ti-notepad"></span>
                    </li>
                    <li data-clipboard-text="ti-server">
                        <span class="ti-server"></span>
                    </li>

                    <li data-clipboard-text="ti-pulse">
                        <span class="ti-pulse"></span>
                    </li>
                    <li data-clipboard-text="ti-printer">
                        <span class="ti-printer"></span>
                    </li>
                    <li data-clipboard-text="ti-power-off">
                        <span class="ti-power-off"></span>
                    </li>
                    <li data-clipboard-text="ti-plug">
                        <span class="ti-plug"></span>
                    </li>
                    <li data-clipboard-text="ti-pie-chart">
                        <span class="ti-pie-chart"></span>
                    </li>

                    <li data-clipboard-text="ti-panel">
                        <span class="ti-panel"></span>
                    </li>
                    <li data-clipboard-text="ti-package">
                        <span class="ti-package"></span>
                    </li>
                    <li data-clipboard-text="ti-music">
                        <span class="ti-music"></span>
                    </li>
                    <li data-clipboard-text="ti-music-alt">
                        <span class="ti-music-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-mouse">
                        <span class="ti-mouse"></span>
                    </li>
                    <li data-clipboard-text="ti-mouse-alt">
                        <span class="ti-mouse-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-money">
                        <span class="ti-money"></span>
                    </li>
                    <li data-clipboard-text="ti-microphone">
                        <span class="ti-microphone"></span>
                    </li>
                    <li data-clipboard-text="ti-menu">
                        <span class="ti-menu"></span>
                    </li>
                    <li data-clipboard-text="ti-menu-alt">
                        <span class="ti-menu-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-map">
                        <span class="ti-map"></span>
                    </li>
                    <li data-clipboard-text="ti-map-alt">
                        <span class="ti-map-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-location-pin">
                        <span class="ti-location-pin"></span>
                    </li>

                    <li data-clipboard-text="ti-light-bulb">
                        <span class="ti-light-bulb"></span>
                    </li>
                    <li data-clipboard-text="ti-info">
                        <span class="ti-info"></span>
                    </li>
                    <li data-clipboard-text="ti-infinite">
                        <span class="ti-infinite"></span>
                    </li>
                    <li data-clipboard-text="ti-id-badge">
                        <span class="ti-id-badge"></span>
                    </li>
                    <li data-clipboard-text="ti-hummer">
                        <span class="ti-hummer"></span>
                    </li>
                    <li data-clipboard-text="ti-home">
                        <span class="ti-home"></span>
                    </li>
                    <li data-clipboard-text="ti-help">
                        <span class="ti-help"></span>
                    </li>
                    <li data-clipboard-text="ti-headphone">
                        <span class="ti-headphone"></span>
                    </li>
                    <li data-clipboard-text="ti-harddrives">
                        <span class="ti-harddrives"></span>
                    </li>
                    <li data-clipboard-text="ti-harddrive">
                        <span class="ti-harddrive"></span>
                    </li>
                    <li data-clipboard-text="ti-gift">
                        <span class="ti-gift"></span>
                    </li>
                    <li data-clipboard-text="ti-game">
                        <span class="ti-game"></span>
                    </li>
                    <li data-clipboard-text="ti-filter">
                        <span class="ti-filter"></span>
                    </li>
                    <li data-clipboard-text="ti-files">
                        <span class="ti-files"></span>
                    </li>
                    <li data-clipboard-text="ti-file">
                        <span class="ti-file"></span>
                    </li>
                    <li data-clipboard-text="ti-zip">
                        <span class="ti-zip"></span>
                    </li>
                    <li data-clipboard-text="ti-folder">
                        <span class="ti-folder"></span>
                    </li>
                    <li data-clipboard-text="ti-envelope">
                        <span class="ti-envelope"></span>
                    </li>

                    <li data-clipboard-text="ti-dashboard">
                        <span class="ti-dashboard"></span>
                    </li>
                    <li data-clipboard-text="ti-cloud">
                        <span class="ti-cloud"></span>
                    </li>
                    <li data-clipboard-text="ti-cloud-up">
                        <span class="ti-cloud-up"></span>
                    </li>
                    <li data-clipboard-text="ti-cloud-down">
                        <span class="ti-cloud-down"></span>
                    </li>
                    <li data-clipboard-text="ti-clipboard">
                        <span class="ti-clipboard"></span>
                    </li>
                    <li data-clipboard-text="ti-calendar">
                        <span class="ti-calendar"></span>
                    </li>
                    <li data-clipboard-text="ti-book">
                        <span class="ti-book"></span>
                    </li>
                    <li data-clipboard-text="ti-bell">
                        <span class="ti-bell"></span>
                    </li>
                    <li data-clipboard-text="ti-basketball">
                        <span class="ti-basketball"></span>
                    </li>
                    <li data-clipboard-text="ti-bar-chart">
                        <span class="ti-bar-chart"></span>
                    </li>
                    <li data-clipboard-text="ti-bar-chart-alt">
                        <span class="ti-bar-chart-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-archive">
                        <span class="ti-archive"></span>
                    </li>
                    <li data-clipboard-text="ti-anchor">
                        <span class="ti-anchor"></span>
                    </li>

                    <li data-clipboard-text="ti-alert">
                        <span class="ti-alert"></span>
                    </li>
                    <li data-clipboard-text="ti-alarm-clock">
                        <span class="ti-alarm-clock"></span>
                    </li>
                    <li data-clipboard-text="ti-agenda">
                        <span class="ti-agenda"></span>
                    </li>
                    <li data-clipboard-text="ti-write">
                        <span class="ti-write"></span>
                    </li>

                    <li data-clipboard-text="ti-wallet">
                        <span class="ti-wallet"></span>
                    </li>
                    <li data-clipboard-text="ti-video-clapper">
                        <span class="ti-video-clapper"></span>
                    </li>
                    <li data-clipboard-text="ti-video-camera">
                        <span class="ti-video-camera"></span>
                    </li>
                    <li data-clipboard-text="ti-vector">
                        <span class="ti-vector"></span>
                    </li>

                    <li data-clipboard-text="ti-support">
                        <span class="ti-support"></span>
                    </li>
                    <li data-clipboard-text="ti-stamp">
                        <span class="ti-stamp"></span>
                    </li>
                    <li data-clipboard-text="ti-slice">
                        <span class="ti-slice"></span>
                    </li>
                    <li data-clipboard-text="ti-shortcode">
                        <span class="ti-shortcode"></span>
                    </li>
                    <li data-clipboard-text="ti-receipt">
                        <span class="ti-receipt"></span>
                    </li>
                    <li data-clipboard-text="ti-pin2">
                        <span class="ti-pin2"></span>
                    </li>
                    <li data-clipboard-text="ti-pin-alt">
                        <span class="ti-pin-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-pencil-alt2">
                        <span class="ti-pencil-alt2"></span>
                    </li>
                    <li data-clipboard-text="ti-eraser">
                        <span class="ti-eraser"></span>
                    </li>
                    <li data-clipboard-text="ti-more">
                        <span class="ti-more"></span>
                    </li>
                    <li data-clipboard-text="ti-more-alt">
                        <span class="ti-more-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-microphone-alt">
                        <span class="ti-microphone-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-magnet">
                        <span class="ti-magnet"></span>
                    </li>
                    <li data-clipboard-text="ti-line-double">
                        <span class="ti-line-double"></span>
                    </li>
                    <li data-clipboard-text="ti-line-dotted">
                        <span class="ti-line-dotted"></span>
                    </li>
                    <li data-clipboard-text="ti-line-dashed">
                        <span class="ti-line-dashed"></span>
                    </li>

                    <li data-clipboard-text="ti-ink-pen">
                        <span class="ti-ink-pen"></span>
                    </li>
                    <li data-clipboard-text="ti-info-alt">
                        <span class="ti-info-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-help-alt">
                        <span class="ti-help-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-headphone-alt">
                        <span class="ti-headphone-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-gallery">
                        <span class="ti-gallery"></span>
                    </li>
                    <li data-clipboard-text="ti-face-smile">
                        <span class="ti-face-smile"></span>
                    </li>
                    <li data-clipboard-text="ti-face-sad">
                        <span class="ti-face-sad"></span>
                    </li>
                    <li data-clipboard-text="ti-credit-card">
                        <span class="ti-credit-card"></span>
                    </li>
                    <li data-clipboard-text="ti-comments-smiley">
                        <span class="ti-comments-smiley"></span>
                    </li>
                    <li data-clipboard-text="ti-time">
                        <span class="ti-time"></span>
                    </li>
                    <li data-clipboard-text="ti-share">
                        <span class="ti-share"></span>
                    </li>
                    <li data-clipboard-text="ti-share-alt">
                        <span class="ti-share-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-rocket">
                        <span class="ti-rocket"></span>
                    </li>

                    <li data-clipboard-text="ti-new-window">
                        <span class="ti-new-window"></span>
                    </li>

                    <li data-clipboard-text="ti-rss">
                        <span class="ti-rss"></span>
                    </li>
                    <li data-clipboard-text="ti-rss-alt">
                        <span class="ti-rss-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-up">
                        <span class="ti-arrow-up"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-right">
                        <span class="ti-arrow-right"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-left">
                        <span class="ti-arrow-left"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-down">
                        <span class="ti-arrow-down"></span>
                    </li>
                    <li data-clipboard-text="ti-arrows-vertical">
                        <span class="ti-arrows-vertical"></span>
                    </li>
                    <li data-clipboard-text="ti-arrows-horizontal">
                        <span class="ti-arrows-horizontal"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-up">
                        <span class="ti-angle-up"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-right">
                        <span class="ti-angle-right"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-left">
                        <span class="ti-angle-left"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-down">
                        <span class="ti-angle-down"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-double-up">
                        <span class="ti-angle-double-up"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-double-right">
                        <span class="ti-angle-double-right"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-double-left">
                        <span class="ti-angle-double-left"></span>
                    </li>
                    <li data-clipboard-text="ti-angle-double-down">
                        <span class="ti-angle-double-down"></span>
                    </li>
                    <li data-clipboard-text="ti-move">
                        <span class="ti-move"></span>
                    </li>
                    <li data-clipboard-text="ti-fullscreen">
                        <span class="ti-fullscreen"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-top-right">
                        <span class="ti-arrow-top-right"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-top-left">
                        <span class="ti-arrow-top-left"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-circle-up">
                        <span class="ti-arrow-circle-up"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-circle-right">
                        <span class="ti-arrow-circle-right"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-circle-left">
                        <span class="ti-arrow-circle-left"></span>
                    </li>
                    <li data-clipboard-text="ti-arrow-circle-down">
                        <span class="ti-arrow-circle-down"></span>
                    </li>
                    <li data-clipboard-text="ti-arrows-corner">
                        <span class="ti-arrows-corner"></span>
                    </li>
                    <li data-clipboard-text="ti-split-v">
                        <span class="ti-split-v"></span>
                    </li>
                    <li data-clipboard-text="ti-split-v-alt">
                        <span class="ti-split-v-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-split-h">
                        <span class="ti-split-h"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-point-up">
                        <span class="ti-hand-point-up"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-point-right">
                        <span class="ti-hand-point-right"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-point-left">
                        <span class="ti-hand-point-left"></span>
                    </li>
                    <li data-clipboard-text="ti-hand-point-down">
                        <span class="ti-hand-point-down"></span>
                    </li>
                    <li data-clipboard-text="ti-back-right">
                        <span class="ti-back-right"></span>
                    </li>
                    <li data-clipboard-text="ti-back-left">
                        <span class="ti-back-left"></span>
                    </li>
                    <li data-clipboard-text="ti-exchange-vertical">
                        <span class="ti-exchange-vertical"></span>
                    </li>
                    <li data-clipboard-text="ti-control-stop">
                        <span class="ti-control-stop"></span>
                    </li>
                    <li data-clipboard-text="ti-control-shuffle">
                        <span class="ti-control-shuffle"></span>
                    </li>
                    <li data-clipboard-text="ti-control-play">
                        <span class="ti-control-play"></span>
                    </li>
                    <li data-clipboard-text="ti-control-pause">
                        <span class="ti-control-pause"></span>
                    </li>
                    <li data-clipboard-text="ti-control-forward">
                        <span class="ti-control-forward"></span>
                    </li>
                    <li data-clipboard-text="ti-control-backward">
                        <span class="ti-control-backward"></span>
                    </li>
                    <li data-clipboard-text="ti-volume">
                        <span class="ti-volume"></span>
                    </li>
                    <li data-clipboard-text="ti-control-skip-forward">
                        <span class="ti-control-skip-forward"></span>
                    </li>
                    <li data-clipboard-text="ti-control-skip-backward">
                        <span class="ti-control-skip-backward"></span>
                    </li>
                    <li data-clipboard-text="ti-control-record">
                        <span class="ti-control-record"></span>
                    </li>
                    <li data-clipboard-text="ti-control-eject">
                        <span class="ti-control-eject"></span>
                    </li>
                    <li data-clipboard-text="ti-paragraph">
                        <span class="ti-paragraph"></span>
                    </li>
                    <li data-clipboard-text="ti-uppercase">
                        <span class="ti-uppercase"></span>
                    </li>
                    <li data-clipboard-text="ti-underline">
                        <span class="ti-underline"></span>
                    </li>
                    <li data-clipboard-text="ti-text">
                        <span class="ti-text"></span>
                    </li>
                    <li data-clipboard-text="ti-Italic">
                        <span class="ti-Italic"></span>
                    </li>
                    <li data-clipboard-text="ti-smallcap">
                        <span class="ti-smallcap"></span>
                    </li>
                    <li data-clipboard-text="ti-list">
                        <span class="ti-list"></span>
                    </li>
                    <li data-clipboard-text="ti-list-ol">
                        <span class="ti-list-ol"></span>
                    </li>
                    <li data-clipboard-text="ti-align-right">
                        <span class="ti-align-right"></span>
                    </li>
                    <li data-clipboard-text="ti-align-left">
                        <span class="ti-align-left"></span>
                    </li>
                    <li data-clipboard-text="ti-align-justify">
                        <span class="ti-align-justify"></span>
                    </li>
                    <li data-clipboard-text="ti-align-center">
                        <span class="ti-align-center"></span>
                    </li>
                    <li data-clipboard-text="ti-quote-right">
                        <span class="ti-quote-right"></span>
                    </li>
                    <li data-clipboard-text="ti-quote-left">
                        <span class="ti-quote-left"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-width-full">
                        <span class="ti-layout-width-full"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-width-default">
                        <span class="ti-layout-width-default"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-width-default-alt">
                        <span class="ti-layout-width-default-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-tab">
                        <span class="ti-layout-tab"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-tab-window">
                        <span class="ti-layout-tab-window"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-tab-v">
                        <span class="ti-layout-tab-v"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-tab-min">
                        <span class="ti-layout-tab-min"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-slider">
                        <span class="ti-layout-slider"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-slider-alt">
                        <span class="ti-layout-slider-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-sidebar-right">
                        <span class="ti-layout-sidebar-right"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-sidebar-none">
                        <span class="ti-layout-sidebar-none"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-sidebar-left">
                        <span class="ti-layout-sidebar-left"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-placeholder">
                        <span class="ti-layout-placeholder"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-menu">
                        <span class="ti-layout-menu"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-menu-v">
                        <span class="ti-layout-menu-v"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-menu-separated">
                        <span class="ti-layout-menu-separated"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-menu-full">
                        <span class="ti-layout-menu-full"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-right">
                        <span class="ti-layout-media-right"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-right-alt">
                        <span class="ti-layout-media-right-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-overlay">
                        <span class="ti-layout-media-overlay"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-overlay-alt">
                        <span class="ti-layout-media-overlay-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-overlay-alt-2">
                        <span class="ti-layout-media-overlay-alt-2"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-left">
                        <span class="ti-layout-media-left"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-left-alt">
                        <span class="ti-layout-media-left-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-center">
                        <span class="ti-layout-media-center"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-media-center-alt">
                        <span class="ti-layout-media-center-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-list-thumb">
                        <span class="ti-layout-list-thumb"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-list-thumb-alt">
                        <span class="ti-layout-list-thumb-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-list-post">
                        <span class="ti-layout-list-post"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-list-large-image">
                        <span class="ti-layout-list-large-image"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-line-solid">
                        <span class="ti-layout-line-solid"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid4">
                        <span class="ti-layout-grid4"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid3">
                        <span class="ti-layout-grid3"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid2">
                        <span class="ti-layout-grid2"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid2-thumb">
                        <span class="ti-layout-grid2-thumb"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-cta-right">
                        <span class="ti-layout-cta-right"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-cta-left">
                        <span class="ti-layout-cta-left"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-cta-center">
                        <span class="ti-layout-cta-center"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-cta-btn-right">
                        <span class="ti-layout-cta-btn-right"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-cta-btn-left">
                        <span class="ti-layout-cta-btn-left"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column4">
                        <span class="ti-layout-column4"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column3">
                        <span class="ti-layout-column3"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column2">
                        <span class="ti-layout-column2"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-accordion-separated">
                        <span class="ti-layout-accordion-separated"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-accordion-merged">
                        <span class="ti-layout-accordion-merged"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-accordion-list">
                        <span class="ti-layout-accordion-list"></span>
                    </li>
                    <li data-clipboard-text="ti-widgetized">
                        <span class="ti-widgetized"></span>
                    </li>
                    <li data-clipboard-text="ti-widget">
                        <span class="ti-widget"></span>
                    </li>
                    <li data-clipboard-text="ti-widget-alt">
                        <span class="ti-widget-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-view-list">
                        <span class="ti-view-list"></span>
                    </li>
                    <li data-clipboard-text="ti-view-list-alt">
                        <span class="ti-view-list-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-view-grid">
                        <span class="ti-view-grid"></span>
                    </li>
                    <li data-clipboard-text="ti-upload">
                        <span class="ti-upload"></span>
                    </li>
                    <li data-clipboard-text="ti-download">
                        <span class="ti-download"></span>
                    </li>
                    <li data-clipboard-text="ti-loop">
                        <span class="ti-loop"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-sidebar-2">
                        <span class="ti-layout-sidebar-2"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid4-alt">
                        <span class="ti-layout-grid4-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid3-alt">
                        <span class="ti-layout-grid3-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-grid2-alt">
                        <span class="ti-layout-grid2-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column4-alt">
                        <span class="ti-layout-column4-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column3-alt">
                        <span class="ti-layout-column3-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-layout-column2-alt">
                        <span class="ti-layout-column2-alt"></span>
                    </li>

                    <li data-clipboard-text="ti-flickr">
                        <span class="ti-flickr"></span>
                    </li>
                    <li data-clipboard-text="ti-flickr-alt">
                        <span class="ti-flickr-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-instagram">
                        <span class="ti-instagram"></span>
                    </li>
                    <li data-clipboard-text="ti-google">
                        <span class="ti-google"></span>
                    </li>
                    <li data-clipboard-text="ti-github">
                        <span class="ti-github"></span>
                    </li>
                    <li data-clipboard-text="ti-facebook">
                        <span class="ti-facebook"></span>
                    </li>
                    <li data-clipboard-text="ti-dropbox">
                        <span class="ti-dropbox"></span>
                    </li>
                    <li data-clipboard-text="ti-dropbox-alt">
                        <span class="ti-dropbox-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-dribbble">
                        <span class="ti-dribbble"></span>
                    </li>
                    <li data-clipboard-text="ti-apple">
                        <span class="ti-apple"></span>
                    </li>
                    <li data-clipboard-text="ti-android">
                        <span class="ti-android"></span>
                    </li>
                    <li data-clipboard-text="ti-yahoo">
                        <span class="ti-yahoo"></span>
                    </li>
                    <li data-clipboard-text="ti-trello">
                        <span class="ti-trello"></span>
                    </li>
                    <li data-clipboard-text="ti-stack-overflow">
                        <span class="ti-stack-overflow"></span>
                    </li>
                    <li data-clipboard-text="ti-soundcloud">
                        <span class="ti-soundcloud"></span>
                    </li>
                    <li data-clipboard-text="ti-sharethis">
                        <span class="ti-sharethis"></span>
                    </li>
                    <li data-clipboard-text="ti-sharethis-alt">
                        <span class="ti-sharethis-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-reddit">
                        <span class="ti-reddit"></span>
                    </li>
                    <li data-clipboard-text="ti-microsoft">
                        <span class="ti-microsoft"></span>
                    </li>
                    <li data-clipboard-text="ti-microsoft-alt">
                        <span class="ti-microsoft-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-linux">
                        <span class="ti-linux"></span>
                    </li>
                    <li data-clipboard-text="ti-jsfiddle">
                        <span class="ti-jsfiddle"></span>
                    </li>
                    <li data-clipboard-text="ti-joomla">
                        <span class="ti-joomla"></span>
                    </li>
                    <li data-clipboard-text="ti-html5">
                        <span class="ti-html5"></span>
                    </li>
                    <li data-clipboard-text="ti-css3">
                        <span class="ti-css3"></span>
                    </li>
                    <li data-clipboard-text="ti-drupal">
                        <span class="ti-drupal"></span>
                    </li>
                    <li data-clipboard-text="ti-wordpress">
                        <span class="ti-wordpress"></span>
                    </li>
                    <li data-clipboard-text="ti-tumblr">
                        <span class="ti-tumblr"></span>
                    </li>
                    <li data-clipboard-text="ti-tumblr-alt">
                        <span class="ti-tumblr-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-skype">
                        <span class="ti-skype"></span>
                    </li>
                    <li data-clipboard-text="ti-youtube">
                        <span class="ti-youtube"></span>
                    </li>
                    <li data-clipboard-text="ti-vimeo">
                        <span class="ti-vimeo"></span>
                    </li>
                    <li data-clipboard-text="ti-vimeo-alt">
                        <span class="ti-vimeo-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-twitter">
                        <span class="ti-twitter"></span>
                    </li>
                    <li data-clipboard-text="ti-twitter-alt">
                        <span class="ti-twitter-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-linkedin">
                        <span class="ti-linkedin"></span>
                    </li>
                    <li data-clipboard-text="ti-pinterest">
                        <span class="ti-pinterest"></span>
                    </li>
                    <li data-clipboard-text="ti-pinterest-alt">
                        <span class="ti-pinterest-alt"></span>
                    </li>
                    <li data-clipboard-text="ti-themify-logo">
                        <span class="ti-themify-logo"></span>
                    </li>
                    <li data-clipboard-text="ti-themify-favicon">
                        <span class="ti-themify-favicon"></span>
                    </li>
                    <li data-clipboard-text="ti-themify-favicon-alt">
                        <span class="ti-themify-favicon-alt"></span>
                    </li>
                </ul>
            </div>
            <div id="tab-2" class="tab-pane fade">
                <ul class="demo-icons-list">
                    <li data-clipboard-text="fa fa-adjust">
                        <span class="fa fa-adjust"></span>
                    </li>
                    <li data-clipboard-text="fa fa-american-sign-language-interpreting">
                        <span class="fa fa-american-sign-language-interpreting"></span>
                    </li>
                    <li data-clipboard-text="fa fa-anchor">
                        <span class="fa fa-anchor"></span>
                    </li>
                    <li data-clipboard-text="fa fa-archive">
                        <span class="fa fa-archive"></span>
                    </li>
                    <li data-clipboard-text="fa fa-area-chart">
                        <span class="fa fa-area-chart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-arrows">
                        <span class="fa fa-arrows"></span>
                    </li>
                    <li data-clipboard-text="fa fa-arrows-h">
                        <span class="fa fa-arrows-h"></span>
                    </li>
                    <li data-clipboard-text="fa fa-arrows-v">
                        <span class="fa fa-arrows-v"></span>
                    </li>
                    <li data-clipboard-text="fa fa-asl-interpreting">
                        <span class="fa fa-asl-interpreting"></span>
                    </li>
                    <li data-clipboard-text="fa fa-assistive-listening-systems">
                        <span class="fa fa-assistive-listening-systems"></span>
                    </li>
                    <li data-clipboard-text="fa fa-asterisk">
                        <span class="fa fa-asterisk"></span>
                    </li>
                    <li data-clipboard-text="fa fa-at">
                        <span class="fa fa-at"></span>
                    </li>
                    <li data-clipboard-text="fa fa-audio-description">
                        <span class="fa fa-audio-description"></span>
                    </li>
                    <li data-clipboard-text="fa fa-automobile">
                        <span class="fa fa-automobile"></span>
                    </li>
                    <li data-clipboard-text="fa fa-balance-scale">
                        <span class="fa fa-balance-scale"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ban">
                        <span class="fa fa-ban"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bank">
                        <span class="fa fa-bank"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bar-chart">
                        <span class="fa fa-bar-chart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bar-chart-o">
                        <span class="fa fa-bar-chart-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-barcode">
                        <span class="fa fa-barcode"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bars">
                        <span class="fa fa-bars"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-0">
                        <span class="fa fa-battery-0"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-1">
                        <span class="fa fa-battery-1"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-2">
                        <span class="fa fa-battery-2"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-3">
                        <span class="fa fa-battery-3"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-4">
                        <span class="fa fa-battery-4"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-empty">
                        <span class="fa fa-battery-empty"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-full">
                        <span class="fa fa-battery-full"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-half">
                        <span class="fa fa-battery-half"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-quarter">
                        <span class="fa fa-battery-quarter"></span>
                    </li>
                    <li data-clipboard-text="fa fa-battery-three-quarters">
                        <span class="fa fa-battery-three-quarters"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bed">
                        <span class="fa fa-bed"></span>
                    </li>
                    <li data-clipboard-text="fa fa-beer">
                        <span class="fa fa-beer"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bell">
                        <span class="fa fa-bell"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bell-o">
                        <span class="fa fa-bell-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bell-slash">
                        <span class="fa fa-bell-slash"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bell-slash-o">
                        <span class="fa fa-bell-slash-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bicycle">
                        <span class="fa fa-bicycle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-binoculars">
                        <span class="fa fa-binoculars"></span>
                    </li>
                    <li data-clipboard-text="fa fa-birthday-cake">
                        <span class="fa fa-birthday-cake"></span>
                    </li>
                    <li data-clipboard-text="fa fa-blind">
                        <span class="fa fa-blind"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bluetooth">
                        <span class="fa fa-bluetooth"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bluetooth-b">
                        <span class="fa fa-bluetooth-b"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bolt">
                        <span class="fa fa-bolt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bomb">
                        <span class="fa fa-bomb"></span>
                    </li>
                    <li data-clipboard-text="fa fa-book">
                        <span class="fa fa-book"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bookmark">
                        <span class="fa fa-bookmark"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bookmark-o">
                        <span class="fa fa-bookmark-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-braille">
                        <span class="fa fa-braille"></span>
                    </li>
                    <li data-clipboard-text="fa fa-briefcase">
                        <span class="fa fa-briefcase"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bug">
                        <span class="fa fa-bug"></span>
                    </li>
                    <li data-clipboard-text="fa fa-building">
                        <span class="fa fa-building"></span>
                    </li>
                    <li data-clipboard-text="fa fa-building-o">
                        <span class="fa fa-building-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bullhorn">
                        <span class="fa fa-bullhorn"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bullseye">
                        <span class="fa fa-bullseye"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bus">
                        <span class="fa fa-bus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cab">
                        <span class="fa fa-cab"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calculator">
                        <span class="fa fa-calculator"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar">
                        <span class="fa fa-calendar"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar-check-o">
                        <span class="fa fa-calendar-check-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar-minus-o">
                        <span class="fa fa-calendar-minus-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar-o">
                        <span class="fa fa-calendar-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar-plus-o">
                        <span class="fa fa-calendar-plus-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-calendar-times-o">
                        <span class="fa fa-calendar-times-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-camera">
                        <span class="fa fa-camera"></span>
                    </li>
                    <li data-clipboard-text="fa fa-camera-retro">
                        <span class="fa fa-camera-retro"></span>
                    </li>
                    <li data-clipboard-text="fa fa-car">
                        <span class="fa fa-car"></span>
                    </li>
                    <li data-clipboard-text="fa fa-caret-square-o-down">
                        <span class="fa fa-caret-square-o-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-caret-square-o-left">
                        <span class="fa fa-caret-square-o-left"></span>
                    </li>
                    <li data-clipboard-text="fa fa-caret-square-o-right">
                        <span class="fa fa-caret-square-o-right"></span>
                    </li>
                    <li data-clipboard-text="fa fa-caret-square-o-up">
                        <span class="fa fa-caret-square-o-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cart-arrow-down">
                        <span class="fa fa-cart-arrow-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cart-plus">
                        <span class="fa fa-cart-plus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cc">
                        <span class="fa fa-cc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-certificate">
                        <span class="fa fa-certificate"></span>
                    </li>
                    <li data-clipboard-text="fa fa-check">
                        <span class="fa fa-check"></span>
                    </li>
                    <li data-clipboard-text="fa fa-check-circle">
                        <span class="fa fa-check-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-check-circle-o">
                        <span class="fa fa-check-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-check-square">
                        <span class="fa fa-check-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-check-square-o">
                        <span class="fa fa-check-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-child">
                        <span class="fa fa-child"></span>
                    </li>
                    <li data-clipboard-text="fa fa-circle">
                        <span class="fa fa-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-circle-o">
                        <span class="fa fa-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-circle-o-notch">
                        <span class="fa fa-circle-o-notch"></span>
                    </li>
                    <li data-clipboard-text="fa fa-circle-thin">
                        <span class="fa fa-circle-thin"></span>
                    </li>
                    <li data-clipboard-text="fa fa-clock-o">
                        <span class="fa fa-clock-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-clone">
                        <span class="fa fa-clone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-close">
                        <span class="fa fa-close"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cloud">
                        <span class="fa fa-cloud"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cloud-download">
                        <span class="fa fa-cloud-download"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cloud-upload">
                        <span class="fa fa-cloud-upload"></span>
                    </li>
                    <li data-clipboard-text="fa fa-code">
                        <span class="fa fa-code"></span>
                    </li>
                    <li data-clipboard-text="fa fa-code-fork">
                        <span class="fa fa-code-fork"></span>
                    </li>
                    <li data-clipboard-text="fa fa-coffee">
                        <span class="fa fa-coffee"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cog">
                        <span class="fa fa-cog"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cogs">
                        <span class="fa fa-cogs"></span>
                    </li>
                    <li data-clipboard-text="fa fa-comment">
                        <span class="fa fa-comment"></span>
                    </li>
                    <li data-clipboard-text="fa fa-comment-o">
                        <span class="fa fa-comment-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-commenting">
                        <span class="fa fa-commenting"></span>
                    </li>
                    <li data-clipboard-text="fa fa-commenting-o">
                        <span class="fa fa-commenting-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-comments">
                        <span class="fa fa-comments"></span>
                    </li>
                    <li data-clipboard-text="fa fa-comments-o">
                        <span class="fa fa-comments-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-compass">
                        <span class="fa fa-compass"></span>
                    </li>
                    <li data-clipboard-text="fa fa-copyright">
                        <span class="fa fa-copyright"></span>
                    </li>
                    <li data-clipboard-text="fa fa-creative-commons">
                        <span class="fa fa-creative-commons"></span>
                    </li>
                    <li data-clipboard-text="fa fa-credit-card">
                        <span class="fa fa-credit-card"></span>
                    </li>
                    <li data-clipboard-text="fa fa-credit-card-alt">
                        <span class="fa fa-credit-card-alt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-crop">
                        <span class="fa fa-crop"></span>
                    </li>
                    <li data-clipboard-text="fa fa-crosshairs">
                        <span class="fa fa-crosshairs"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cube">
                        <span class="fa fa-cube"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cubes">
                        <span class="fa fa-cubes"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cutlery">
                        <span class="fa fa-cutlery"></span>
                    </li>
                    <li data-clipboard-text="fa fa-dashboard">
                        <span class="fa fa-dashboard"></span>
                    </li>
                    <li data-clipboard-text="fa fa-database">
                        <span class="fa fa-database"></span>
                    </li>
                    <li data-clipboard-text="fa fa-deaf">
                        <span class="fa fa-deaf"></span>
                    </li>
                    <li data-clipboard-text="fa fa-deafness">
                        <span class="fa fa-deafness"></span>
                    </li>
                    <li data-clipboard-text="fa fa-desktop">
                        <span class="fa fa-desktop"></span>
                    </li>
                    <li data-clipboard-text="fa fa-diamond">
                        <span class="fa fa-diamond"></span>
                    </li>
                    <li data-clipboard-text="fa fa-dot-circle-o">
                        <span class="fa fa-dot-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-download">
                        <span class="fa fa-download"></span>
                    </li>
                    <li data-clipboard-text="fa fa-edit">
                        <span class="fa fa-edit"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ellipsis-h">
                        <span class="fa fa-ellipsis-h"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ellipsis-v">
                        <span class="fa fa-ellipsis-v"></span>
                    </li>
                    <li data-clipboard-text="fa fa-envelope">
                        <span class="fa fa-envelope"></span>
                    </li>
                    <li data-clipboard-text="fa fa-envelope-o">
                        <span class="fa fa-envelope-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-envelope-square">
                        <span class="fa fa-envelope-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-eraser">
                        <span class="fa fa-eraser"></span>
                    </li>
                    <li data-clipboard-text="fa fa-exchange">
                        <span class="fa fa-exchange"></span>
                    </li>
                    <li data-clipboard-text="fa fa-exclamation">
                        <span class="fa fa-exclamation"></span>
                    </li>
                    <li data-clipboard-text="fa fa-exclamation-circle">
                        <span class="fa fa-exclamation-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-exclamation-triangle">
                        <span class="fa fa-exclamation-triangle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-external-link">
                        <span class="fa fa-external-link"></span>
                    </li>
                    <li data-clipboard-text="fa fa-external-link-square">
                        <span class="fa fa-external-link-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-eye">
                        <span class="fa fa-eye"></span>
                    </li>
                    <li data-clipboard-text="fa fa-eye-slash">
                        <span class="fa fa-eye-slash"></span>
                    </li>
                    <li data-clipboard-text="fa fa-eyedropper">
                        <span class="fa fa-eyedropper"></span>
                    </li>
                    <li data-clipboard-text="fa fa-fax">
                        <span class="fa fa-fax"></span>
                    </li>
                    <li data-clipboard-text="fa fa-feed">
                        <span class="fa fa-feed"></span>
                    </li>
                    <li data-clipboard-text="fa fa-female">
                        <span class="fa fa-female"></span>
                    </li>
                    <li data-clipboard-text="fa fa-fighter-jet">
                        <span class="fa fa-fighter-jet"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-archive-o">
                        <span class="fa fa-file-archive-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-audio-o">
                        <span class="fa fa-file-audio-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-code-o">
                        <span class="fa fa-file-code-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-excel-o">
                        <span class="fa fa-file-excel-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-image-o">
                        <span class="fa fa-file-image-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-movie-o">
                        <span class="fa fa-file-movie-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-pdf-o">
                        <span class="fa fa-file-pdf-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-photo-o">
                        <span class="fa fa-file-photo-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-picture-o">
                        <span class="fa fa-file-picture-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-powerpoint-o">
                        <span class="fa fa-file-powerpoint-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-sound-o">
                        <span class="fa fa-file-sound-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-video-o">
                        <span class="fa fa-file-video-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-word-o">
                        <span class="fa fa-file-word-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-zip-o">
                        <span class="fa fa-file-zip-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-film">
                        <span class="fa fa-film"></span>
                    </li>
                    <li data-clipboard-text="fa fa-filter">
                        <span class="fa fa-filter"></span>
                    </li>
                    <li data-clipboard-text="fa fa-fire">
                        <span class="fa fa-fire"></span>
                    </li>
                    <li data-clipboard-text="fa fa-fire-extinguisher">
                        <span class="fa fa-fire-extinguisher"></span>
                    </li>
                    <li data-clipboard-text="fa fa-flag">
                        <span class="fa fa-flag"></span>
                    </li>
                    <li data-clipboard-text="fa fa-flag-checkered">
                        <span class="fa fa-flag-checkered"></span>
                    </li>
                    <li data-clipboard-text="fa fa-flag-o">
                        <span class="fa fa-flag-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-flash">
                        <span class="fa fa-flash"></span>
                    </li>
                    <li data-clipboard-text="fa fa-flask">
                        <span class="fa fa-flask"></span>
                    </li>
                    <li data-clipboard-text="fa fa-folder">
                        <span class="fa fa-folder"></span>
                    </li>
                    <li data-clipboard-text="fa fa-folder-o">
                        <span class="fa fa-folder-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-folder-open">
                        <span class="fa fa-folder-open"></span>
                    </li>
                    <li data-clipboard-text="fa fa-folder-open-o">
                        <span class="fa fa-folder-open-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-frown-o">
                        <span class="fa fa-frown-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-futbol-o">
                        <span class="fa fa-futbol-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-gamepad">
                        <span class="fa fa-gamepad"></span>
                    </li>
                    <li data-clipboard-text="fa fa-gavel">
                        <span class="fa fa-gavel"></span>
                    </li>
                    <li data-clipboard-text="fa fa-gear">
                        <span class="fa fa-gear"></span>
                    </li>
                    <li data-clipboard-text="fa fa-gears">
                        <span class="fa fa-gears"></span>
                    </li>
                    <li data-clipboard-text="fa fa-gift">
                        <span class="fa fa-gift"></span>
                    </li>
                    <li data-clipboard-text="fa fa-glass">
                        <span class="fa fa-glass"></span>
                    </li>
                    <li data-clipboard-text="fa fa-globe">
                        <span class="fa fa-globe"></span>
                    </li>
                    <li data-clipboard-text="fa fa-graduation-cap">
                        <span class="fa fa-graduation-cap"></span>
                    </li>
                    <li data-clipboard-text="fa fa-group">
                        <span class="fa fa-group"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-grab-o">
                        <span class="fa fa-hand-grab-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-lizard-o">
                        <span class="fa fa-hand-lizard-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-paper-o">
                        <span class="fa fa-hand-paper-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-peace-o">
                        <span class="fa fa-hand-peace-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-pointer-o">
                        <span class="fa fa-hand-pointer-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-rock-o">
                        <span class="fa fa-hand-rock-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-scissors-o">
                        <span class="fa fa-hand-scissors-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-spock-o">
                        <span class="fa fa-hand-spock-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-stop-o">
                        <span class="fa fa-hand-stop-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hard-of-hearing">
                        <span class="fa fa-hard-of-hearing"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hashtag">
                        <span class="fa fa-hashtag"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hdd-o">
                        <span class="fa fa-hdd-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-headphones">
                        <span class="fa fa-headphones"></span>
                    </li>
                    <li data-clipboard-text="fa fa-heart">
                        <span class="fa fa-heart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-heart-o">
                        <span class="fa fa-heart-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-heartbeat">
                        <span class="fa fa-heartbeat"></span>
                    </li>
                    <li data-clipboard-text="fa fa-history">
                        <span class="fa fa-history"></span>
                    </li>
                    <li data-clipboard-text="fa fa-home">
                        <span class="fa fa-home"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hotel">
                        <span class="fa fa-hotel"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass">
                        <span class="fa fa-hourglass"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-1">
                        <span class="fa fa-hourglass-1"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-2">
                        <span class="fa fa-hourglass-2"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-3">
                        <span class="fa fa-hourglass-3"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-end">
                        <span class="fa fa-hourglass-end"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-half">
                        <span class="fa fa-hourglass-half"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-o">
                        <span class="fa fa-hourglass-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hourglass-start">
                        <span class="fa fa-hourglass-start"></span>
                    </li>
                    <li data-clipboard-text="fa fa-i-cursor">
                        <span class="fa fa-i-cursor"></span>
                    </li>
                    <li data-clipboard-text="fa fa-image">
                        <span class="fa fa-image"></span>
                    </li>
                    <li data-clipboard-text="fa fa-inbox">
                        <span class="fa fa-inbox"></span>
                    </li>
                    <li data-clipboard-text="fa fa-industry">
                        <span class="fa fa-industry"></span>
                    </li>
                    <li data-clipboard-text="fa fa-info">
                        <span class="fa fa-info"></span>
                    </li>
                    <li data-clipboard-text="fa fa-info-circle">
                        <span class="fa fa-info-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-institution">
                        <span class="fa fa-institution"></span>
                    </li>
                    <li data-clipboard-text="fa fa-key">
                        <span class="fa fa-key"></span>
                    </li>
                    <li data-clipboard-text="fa fa-keyboard-o">
                        <span class="fa fa-keyboard-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-language">
                        <span class="fa fa-language"></span>
                    </li>
                    <li data-clipboard-text="fa fa-laptop">
                        <span class="fa fa-laptop"></span>
                    </li>
                    <li data-clipboard-text="fa fa-leaf">
                        <span class="fa fa-leaf"></span>
                    </li>
                    <li data-clipboard-text="fa fa-legal">
                        <span class="fa fa-legal"></span>
                    </li>
                    <li data-clipboard-text="fa fa-lemon-o">
                        <span class="fa fa-lemon-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-level-down">
                        <span class="fa fa-level-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-level-up">
                        <span class="fa fa-level-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-life-bouy">
                        <span class="fa fa-life-bouy"></span>
                    </li>
                    <li data-clipboard-text="fa fa-life-buoy">
                        <span class="fa fa-life-buoy"></span>
                    </li>
                    <li data-clipboard-text="fa fa-life-ring">
                        <span class="fa fa-life-ring"></span>
                    </li>
                    <li data-clipboard-text="fa fa-life-saver">
                        <span class="fa fa-life-saver"></span>
                    </li>
                    <li data-clipboard-text="fa fa-lightbulb-o">
                        <span class="fa fa-lightbulb-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-line-chart">
                        <span class="fa fa-line-chart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-location-arrow">
                        <span class="fa fa-location-arrow"></span>
                    </li>
                    <li data-clipboard-text="fa fa-lock">
                        <span class="fa fa-lock"></span>
                    </li>
                    <li data-clipboard-text="fa fa-low-vision">
                        <span class="fa fa-low-vision"></span>
                    </li>
                    <li data-clipboard-text="fa fa-magic">
                        <span class="fa fa-magic"></span>
                    </li>
                    <li data-clipboard-text="fa fa-magnet">
                        <span class="fa fa-magnet"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mail-forward">
                        <span class="fa fa-mail-forward"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mail-reply">
                        <span class="fa fa-mail-reply"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mail-reply-all">
                        <span class="fa fa-mail-reply-all"></span>
                    </li>
                    <li data-clipboard-text="fa fa-male">
                        <span class="fa fa-male"></span>
                    </li>
                    <li data-clipboard-text="fa fa-map">
                        <span class="fa fa-map"></span>
                    </li>
                    <li data-clipboard-text="fa fa-map-marker">
                        <span class="fa fa-map-marker"></span>
                    </li>
                    <li data-clipboard-text="fa fa-map-o">
                        <span class="fa fa-map-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-map-pin">
                        <span class="fa fa-map-pin"></span>
                    </li>
                    <li data-clipboard-text="fa fa-map-signs">
                        <span class="fa fa-map-signs"></span>
                    </li>
                    <li data-clipboard-text="fa fa-meh-o">
                        <span class="fa fa-meh-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-microphone">
                        <span class="fa fa-microphone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-microphone-slash">
                        <span class="fa fa-microphone-slash"></span>
                    </li>
                    <li data-clipboard-text="fa fa-minus">
                        <span class="fa fa-minus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-minus-circle">
                        <span class="fa fa-minus-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-minus-square">
                        <span class="fa fa-minus-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-minus-square-o">
                        <span class="fa fa-minus-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mobile">
                        <span class="fa fa-mobile"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mobile-phone">
                        <span class="fa fa-mobile-phone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-money">
                        <span class="fa fa-money"></span>
                    </li>
                    <li data-clipboard-text="fa fa-moon-o">
                        <span class="fa fa-moon-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mortar-board">
                        <span class="fa fa-mortar-board"></span>
                    </li>
                    <li data-clipboard-text="fa fa-motorcycle">
                        <span class="fa fa-motorcycle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mouse-pointer">
                        <span class="fa fa-mouse-pointer"></span>
                    </li>
                    <li data-clipboard-text="fa fa-music">
                        <span class="fa fa-music"></span>
                    </li>
                    <li data-clipboard-text="fa fa-navicon">
                        <span class="fa fa-navicon"></span>
                    </li>
                    <li data-clipboard-text="fa fa-newspaper-o">
                        <span class="fa fa-newspaper-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-object-group">
                        <span class="fa fa-object-group"></span>
                    </li>
                    <li data-clipboard-text="fa fa-object-ungroup">
                        <span class="fa fa-object-ungroup"></span>
                    </li>
                    <li data-clipboard-text="fa fa-paint-brush">
                        <span class="fa fa-paint-brush"></span>
                    </li>
                    <li data-clipboard-text="fa fa-paper-plane">
                        <span class="fa fa-paper-plane"></span>
                    </li>
                    <li data-clipboard-text="fa fa-paper-plane-o">
                        <span class="fa fa-paper-plane-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-paw">
                        <span class="fa fa-paw"></span>
                    </li>
                    <li data-clipboard-text="fa fa-pencil">
                        <span class="fa fa-pencil"></span>
                    </li>
                    <li data-clipboard-text="fa fa-pencil-square">
                        <span class="fa fa-pencil-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-pencil-square-o">
                        <span class="fa fa-pencil-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-percent">
                        <span class="fa fa-percent"></span>
                    </li>
                    <li data-clipboard-text="fa fa-phone">
                        <span class="fa fa-phone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-phone-square">
                        <span class="fa fa-phone-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-photo">
                        <span class="fa fa-photo"></span>
                    </li>
                    <li data-clipboard-text="fa fa-picture-o">
                        <span class="fa fa-picture-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-pie-chart">
                        <span class="fa fa-pie-chart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plane">
                        <span class="fa fa-plane"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plug">
                        <span class="fa fa-plug"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plus">
                        <span class="fa fa-plus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plus-circle">
                        <span class="fa fa-plus-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plus-square">
                        <span class="fa fa-plus-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plus-square-o">
                        <span class="fa fa-plus-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-power-off">
                        <span class="fa fa-power-off"></span>
                    </li>
                    <li data-clipboard-text="fa fa-print">
                        <span class="fa fa-print"></span>
                    </li>
                    <li data-clipboard-text="fa fa-puzzle-piece">
                        <span class="fa fa-puzzle-piece"></span>
                    </li>
                    <li data-clipboard-text="fa fa-qrcode">
                        <span class="fa fa-qrcode"></span>
                    </li>
                    <li data-clipboard-text="fa fa-question">
                        <span class="fa fa-question"></span>
                    </li>
                    <li data-clipboard-text="fa fa-question-circle">
                        <span class="fa fa-question-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-question-circle-o">
                        <span class="fa fa-question-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-quote-left">
                        <span class="fa fa-quote-left"></span>
                    </li>
                    <li data-clipboard-text="fa fa-quote-right">
                        <span class="fa fa-quote-right"></span>
                    </li>
                    <li data-clipboard-text="fa fa-random">
                        <span class="fa fa-random"></span>
                    </li>
                    <li data-clipboard-text="fa fa-recycle">
                        <span class="fa fa-recycle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-refresh">
                        <span class="fa fa-refresh"></span>
                    </li>
                    <li data-clipboard-text="fa fa-registered">
                        <span class="fa fa-registered"></span>
                    </li>
                    <li data-clipboard-text="fa fa-remove">
                        <span class="fa fa-remove"></span>
                    </li>
                    <li data-clipboard-text="fa fa-reorder">
                        <span class="fa fa-reorder"></span>
                    </li>
                    <li data-clipboard-text="fa fa-reply">
                        <span class="fa fa-reply"></span>
                    </li>
                    <li data-clipboard-text="fa fa-reply-all">
                        <span class="fa fa-reply-all"></span>
                    </li>
                    <li data-clipboard-text="fa fa-retweet">
                        <span class="fa fa-retweet"></span>
                    </li>
                    <li data-clipboard-text="fa fa-road">
                        <span class="fa fa-road"></span>
                    </li>
                    <li data-clipboard-text="fa fa-rocket">
                        <span class="fa fa-rocket"></span>
                    </li>
                    <li data-clipboard-text="fa fa-rss">
                        <span class="fa fa-rss"></span>
                    </li>
                    <li data-clipboard-text="fa fa-rss-square">
                        <span class="fa fa-rss-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-search">
                        <span class="fa fa-search"></span>
                    </li>
                    <li data-clipboard-text="fa fa-search-minus">
                        <span class="fa fa-search-minus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-search-plus">
                        <span class="fa fa-search-plus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-send">
                        <span class="fa fa-send"></span>
                    </li>
                    <li data-clipboard-text="fa fa-send-o">
                        <span class="fa fa-send-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-server">
                        <span class="fa fa-server"></span>
                    </li>
                    <li data-clipboard-text="fa fa-share">
                        <span class="fa fa-share"></span>
                    </li>
                    <li data-clipboard-text="fa fa-share-alt">
                        <span class="fa fa-share-alt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-share-alt-square">
                        <span class="fa fa-share-alt-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-share-square">
                        <span class="fa fa-share-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-share-square-o">
                        <span class="fa fa-share-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-shield">
                        <span class="fa fa-shield"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ship">
                        <span class="fa fa-ship"></span>
                    </li>
                    <li data-clipboard-text="fa fa-shopping-bag">
                        <span class="fa fa-shopping-bag"></span>
                    </li>
                    <li data-clipboard-text="fa fa-shopping-basket">
                        <span class="fa fa-shopping-basket"></span>
                    </li>
                    <li data-clipboard-text="fa fa-shopping-cart">
                        <span class="fa fa-shopping-cart"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sign-in">
                        <span class="fa fa-sign-in"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sign-language">
                        <span class="fa fa-sign-language"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sign-out">
                        <span class="fa fa-sign-out"></span>
                    </li>
                    <li data-clipboard-text="fa fa-signal">
                        <span class="fa fa-signal"></span>
                    </li>
                    <li data-clipboard-text="fa fa-signing">
                        <span class="fa fa-signing"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sitemap">
                        <span class="fa fa-sitemap"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sliders">
                        <span class="fa fa-sliders"></span>
                    </li>
                    <li data-clipboard-text="fa fa-smile-o">
                        <span class="fa fa-smile-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-soccer-ball-o">
                        <span class="fa fa-soccer-ball-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort">
                        <span class="fa fa-sort"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-alpha-asc">
                        <span class="fa fa-sort-alpha-asc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-alpha-desc">
                        <span class="fa fa-sort-alpha-desc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-amount-asc">
                        <span class="fa fa-sort-amount-asc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-amount-desc">
                        <span class="fa fa-sort-amount-desc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-asc">
                        <span class="fa fa-sort-asc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-desc">
                        <span class="fa fa-sort-desc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-down">
                        <span class="fa fa-sort-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-numeric-asc">
                        <span class="fa fa-sort-numeric-asc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-numeric-desc">
                        <span class="fa fa-sort-numeric-desc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sort-up">
                        <span class="fa fa-sort-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-space-shuttle">
                        <span class="fa fa-space-shuttle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-spinner">
                        <span class="fa fa-spinner"></span>
                    </li>
                    <li data-clipboard-text="fa fa-spoon">
                        <span class="fa fa-spoon"></span>
                    </li>
                    <li data-clipboard-text="fa fa-square">
                        <span class="fa fa-square"></span>
                    </li>
                    <li data-clipboard-text="fa fa-square-o">
                        <span class="fa fa-square-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star">
                        <span class="fa fa-star"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star-half">
                        <span class="fa fa-star-half"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star-half-empty">
                        <span class="fa fa-star-half-empty"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star-half-full">
                        <span class="fa fa-star-half-full"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star-half-o">
                        <span class="fa fa-star-half-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-star-o">
                        <span class="fa fa-star-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sticky-note">
                        <span class="fa fa-sticky-note"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sticky-note-o">
                        <span class="fa fa-sticky-note-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-street-view">
                        <span class="fa fa-street-view"></span>
                    </li>
                    <li data-clipboard-text="fa fa-suitcase">
                        <span class="fa fa-suitcase"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sun-o">
                        <span class="fa fa-sun-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-support">
                        <span class="fa fa-support"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tablet">
                        <span class="fa fa-tablet"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tachometer">
                        <span class="fa fa-tachometer"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tag">
                        <span class="fa fa-tag"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tags">
                        <span class="fa fa-tags"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tasks">
                        <span class="fa fa-tasks"></span>
                    </li>
                    <li data-clipboard-text="fa fa-taxi">
                        <span class="fa fa-taxi"></span>
                    </li>
                    <li data-clipboard-text="fa fa-television">
                        <span class="fa fa-television"></span>
                    </li>
                    <li data-clipboard-text="fa fa-terminal">
                        <span class="fa fa-terminal"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumb-tack">
                        <span class="fa fa-thumb-tack"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-down">
                        <span class="fa fa-thumbs-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-o-down">
                        <span class="fa fa-thumbs-o-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-o-up">
                        <span class="fa fa-thumbs-o-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-up">
                        <span class="fa fa-thumbs-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ticket">
                        <span class="fa fa-ticket"></span>
                    </li>
                    <li data-clipboard-text="fa fa-times">
                        <span class="fa fa-times"></span>
                    </li>
                    <li data-clipboard-text="fa fa-times-circle">
                        <span class="fa fa-times-circle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-times-circle-o">
                        <span class="fa fa-times-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tint">
                        <span class="fa fa-tint"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-down">
                        <span class="fa fa-toggle-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-left">
                        <span class="fa fa-toggle-left"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-off">
                        <span class="fa fa-toggle-off"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-on">
                        <span class="fa fa-toggle-on"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-right">
                        <span class="fa fa-toggle-right"></span>
                    </li>
                    <li data-clipboard-text="fa fa-toggle-up">
                        <span class="fa fa-toggle-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-trademark">
                        <span class="fa fa-trademark"></span>
                    </li>
                    <li data-clipboard-text="fa fa-trash">
                        <span class="fa fa-trash"></span>
                    </li>
                    <li data-clipboard-text="fa fa-trash-o">
                        <span class="fa fa-trash-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tree">
                        <span class="fa fa-tree"></span>
                    </li>
                    <li data-clipboard-text="fa fa-trophy">
                        <span class="fa fa-trophy"></span>
                    </li>
                    <li data-clipboard-text="fa fa-truck">
                        <span class="fa fa-truck"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tty">
                        <span class="fa fa-tty"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tv">
                        <span class="fa fa-tv"></span>
                    </li>
                    <li data-clipboard-text="fa fa-umbrella">
                        <span class="fa fa-umbrella"></span>
                    </li>
                    <li data-clipboard-text="fa fa-universal-access">
                        <span class="fa fa-universal-access"></span>
                    </li>
                    <li data-clipboard-text="fa fa-university">
                        <span class="fa fa-university"></span>
                    </li>
                    <li data-clipboard-text="fa fa-unlock">
                        <span class="fa fa-unlock"></span>
                    </li>
                    <li data-clipboard-text="fa fa-unlock-alt">
                        <span class="fa fa-unlock-alt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-unsorted">
                        <span class="fa fa-unsorted"></span>
                    </li>
                    <li data-clipboard-text="fa fa-upload">
                        <span class="fa fa-upload"></span>
                    </li>
                    <li data-clipboard-text="fa fa-user">
                        <span class="fa fa-user"></span>
                    </li>
                    <li data-clipboard-text="fa fa-user-plus">
                        <span class="fa fa-user-plus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-user-secret">
                        <span class="fa fa-user-secret"></span>
                    </li>
                    <li data-clipboard-text="fa fa-user-times">
                        <span class="fa fa-user-times"></span>
                    </li>
                    <li data-clipboard-text="fa fa-users">
                        <span class="fa fa-users"></span>
                    </li>
                    <li data-clipboard-text="fa fa-video-camera">
                        <span class="fa fa-video-camera"></span>
                    </li>
                    <li data-clipboard-text="fa fa-volume-control-phone">
                        <span class="fa fa-volume-control-phone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-volume-down">
                        <span class="fa fa-volume-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-volume-off">
                        <span class="fa fa-volume-off"></span>
                    </li>
                    <li data-clipboard-text="fa fa-volume-up">
                        <span class="fa fa-volume-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-warning">
                        <span class="fa fa-warning"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair">
                        <span class="fa fa-wheelchair"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair-alt">
                        <span class="fa fa-wheelchair-alt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wifi">
                        <span class="fa fa-wifi"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wrench">
                        <span class="fa fa-wrench"></span>
                    </li>
                    <li data-clipboard-text="fa fa-american-sign-language-interpreting">
                        <span class="fa fa-american-sign-language-interpreting"></span>
                    </li>
                    <li data-clipboard-text="fa fa-asl-interpreting">
                        <span class="fa fa-asl-interpreting"></span>
                    </li>
                    <li data-clipboard-text="fa fa-assistive-listening-systems">
                        <span class="fa fa-assistive-listening-systems"></span>
                    </li>
                    <li data-clipboard-text="fa fa-audio-description">
                        <span class="fa fa-audio-description"></span>
                    </li>
                    <li data-clipboard-text="fa fa-blind">
                        <span class="fa fa-blind"></span>
                    </li>
                    <li data-clipboard-text="fa fa-braille">
                        <span class="fa fa-braille"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cc">
                        <span class="fa fa-cc"></span>
                    </li>
                    <li data-clipboard-text="fa fa-deaf">
                        <span class="fa fa-deaf"></span>
                    </li>
                    <li data-clipboard-text="fa fa-deafness">
                        <span class="fa fa-deafness"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hard-of-hearing">
                        <span class="fa fa-hard-of-hearing"></span>
                    </li>
                    <li data-clipboard-text="fa fa-low-vision">
                        <span class="fa fa-low-vision"></span>
                    </li>
                    <li data-clipboard-text="fa fa-question-circle-o">
                        <span class="fa fa-question-circle-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-sign-language">
                        <span class="fa fa-sign-language"></span>
                    </li>
                    <li data-clipboard-text="fa fa-signing">
                        <span class="fa fa-signing"></span>
                    </li>
                    <li data-clipboard-text="fa fa-tty">
                        <span class="fa fa-tty"></span>
                    </li>
                    <li data-clipboard-text="fa fa-universal-access">
                        <span class="fa fa-universal-access"></span>
                    </li>
                    <li data-clipboard-text="fa fa-volume-control-phone">
                        <span class="fa fa-volume-control-phone"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair">
                        <span class="fa fa-wheelchair"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair-alt">
                        <span class="fa fa-wheelchair-alt"></span>
                    </li>

                    <li data-clipboard-text="fa fa-hand-grab-o">
                        <span class="fa fa-hand-grab-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-lizard-o">
                        <span class="fa fa-hand-lizard-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-o-down">
                        <span class="fa fa-hand-o-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-o-left">
                        <span class="fa fa-hand-o-left"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-o-right">
                        <span class="fa fa-hand-o-right"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-o-up">
                        <span class="fa fa-hand-o-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-paper-o">
                        <span class="fa fa-hand-paper-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-peace-o">
                        <span class="fa fa-hand-peace-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-pointer-o">
                        <span class="fa fa-hand-pointer-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-rock-o">
                        <span class="fa fa-hand-rock-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-scissors-o">
                        <span class="fa fa-hand-scissors-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-spock-o">
                        <span class="fa fa-hand-spock-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-hand-stop-o">
                        <span class="fa fa-hand-stop-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-down">
                        <span class="fa fa-thumbs-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-o-down">
                        <span class="fa fa-thumbs-o-down"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-o-up">
                        <span class="fa fa-thumbs-o-up"></span>
                    </li>
                    <li data-clipboard-text="fa fa-thumbs-up">
                        <span class="fa fa-thumbs-up"></span>
                    </li>

                    <li data-clipboard-text="fa fa-ambulance">
                        <span class="fa fa-ambulance"></span>
                    </li>
                    <li data-clipboard-text="fa fa-automobile">
                        <span class="fa fa-automobile"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bicycle">
                        <span class="fa fa-bicycle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-bus">
                        <span class="fa fa-bus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-cab">
                        <span class="fa fa-cab"></span>
                    </li>
                    <li data-clipboard-text="fa fa-car">
                        <span class="fa fa-car"></span>
                    </li>
                    <li data-clipboard-text="fa fa-fighter-jet">
                        <span class="fa fa-fighter-jet"></span>
                    </li>
                    <li data-clipboard-text="fa fa-motorcycle">
                        <span class="fa fa-motorcycle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-plane">
                        <span class="fa fa-plane"></span>
                    </li>
                    <li data-clipboard-text="fa fa-rocket">
                        <span class="fa fa-rocket"></span>
                    </li>
                    <li data-clipboard-text="fa fa-ship">
                        <span class="fa fa-ship"></span>
                    </li>
                    <li data-clipboard-text="fa fa-space-shuttle">
                        <span class="fa fa-space-shuttle"></span>
                    </li>
                    <li data-clipboard-text="fa fa-subway">
                        <span class="fa fa-subway"></span>
                    </li>
                    <li data-clipboard-text="fa fa-taxi">
                        <span class="fa fa-taxi"></span>
                    </li>
                    <li data-clipboard-text="fa fa-train">
                        <span class="fa fa-train"></span>
                    </li>
                    <li data-clipboard-text="fa fa-truck">
                        <span class="fa fa-truck"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair">
                        <span class="fa fa-wheelchair"></span>
                    </li>
                    <li data-clipboard-text="fa fa-wheelchair-alt">
                        <span class="fa fa-wheelchair-alt"></span>
                    </li>

                    <li data-clipboard-text="fa fa-genderless">
                        <span class="fa fa-genderless"></span>
                    </li>
                    <li data-clipboard-text="fa fa-intersex">
                        <span class="fa fa-intersex"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mars">
                        <span class="fa fa-mars"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mars-double">
                        <span class="fa fa-mars-double"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mars-stroke">
                        <span class="fa fa-mars-stroke"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mars-stroke-h">
                        <span class="fa fa-mars-stroke-h"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mars-stroke-v">
                        <span class="fa fa-mars-stroke-v"></span>
                    </li>
                    <li data-clipboard-text="fa fa-mercury">
                        <span class="fa fa-mercury"></span>
                    </li>
                    <li data-clipboard-text="fa fa-neuter">
                        <span class="fa fa-neuter"></span>
                    </li>
                    <li data-clipboard-text="fa fa-transgender">
                        <span class="fa fa-transgender"></span>
                    </li>
                    <li data-clipboard-text="fa fa-transgender-alt">
                        <span class="fa fa-transgender-alt"></span>
                    </li>
                    <li data-clipboard-text="fa fa-venus">
                        <span class="fa fa-venus"></span>
                    </li>
                    <li data-clipboard-text="fa fa-venus-double">
                        <span class="fa fa-venus-double"></span>
                    </li>
                    <li data-clipboard-text="fa fa-venus-mars">
                        <span class="fa fa-venus-mars"></span>
                    </li>

                    <li data-clipboard-text="fa fa-file">
                        <span class="fa fa-file"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-archive-o">
                        <span class="fa fa-file-archive-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-audio-o">
                        <span class="fa fa-file-audio-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-code-o">
                        <span class="fa fa-file-code-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-excel-o">
                        <span class="fa fa-file-excel-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-image-o">
                        <span class="fa fa-file-image-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-movie-o">
                        <span class="fa fa-file-movie-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-o">
                        <span class="fa fa-file-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-pdf-o">
                        <span class="fa fa-file-pdf-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-photo-o">
                        <span class="fa fa-file-photo-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-picture-o">
                        <span class="fa fa-file-picture-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-powerpoint-o">
                        <span class="fa fa-file-powerpoint-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-sound-o">
                        <span class="fa fa-file-sound-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-text">
                        <span class="fa fa-file-text"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-text-o">
                        <span class="fa fa-file-text-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-video-o">
                        <span class="fa fa-file-video-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-word-o">
                        <span class="fa fa-file-word-o"></span>
                    </li>
                    <li data-clipboard-text="fa fa-file-zip-o">
                        <span class="fa fa-file-zip-o"></span>

                        <li data-clipboard-text="fa fa-circle-o-notch">
                            <span class="fa fa-circle-o-notch"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cog">
                            <span class="fa fa-cog"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gear">
                            <span class="fa fa-gear"></span>
                        </li>
                        <li data-clipboard-text="fa fa-refresh">
                            <span class="fa fa-refresh"></span>
                        </li>
                        <li data-clipboard-text="fa fa-spinner">
                            <span class="fa fa-spinner"></span>
                        </li>

                        <li data-clipboard-text="fa fa-check-square">
                            <span class="fa fa-check-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-check-square-o">
                            <span class="fa fa-check-square-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-circle">
                            <span class="fa fa-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-circle-o">
                            <span class="fa fa-circle-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dot-circle-o">
                            <span class="fa fa-dot-circle-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-minus-square">
                            <span class="fa fa-minus-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-minus-square-o">
                            <span class="fa fa-minus-square-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-plus-square">
                            <span class="fa fa-plus-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-plus-square-o">
                            <span class="fa fa-plus-square-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-square">
                            <span class="fa fa-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-square-o">
                            <span class="fa fa-square-o"></span>
                        </li>

                        <li data-clipboard-text="fa fa-cc-amex">
                            <span class="fa fa-cc-amex"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-diners-club">
                            <span class="fa fa-cc-diners-club"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-discover">
                            <span class="fa fa-cc-discover"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-jcb">
                            <span class="fa fa-cc-jcb"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-mastercard">
                            <span class="fa fa-cc-mastercard"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-paypal">
                            <span class="fa fa-cc-paypal"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-stripe">
                            <span class="fa fa-cc-stripe"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-visa">
                            <span class="fa fa-cc-visa"></span>
                        </li>
                        <li data-clipboard-text="fa fa-credit-card">
                            <span class="fa fa-credit-card"></span>
                        </li>
                        <li data-clipboard-text="fa fa-credit-card-alt">
                            <span class="fa fa-credit-card-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-wallet">
                            <span class="fa fa-google-wallet"></span>
                        </li>
                        <li data-clipboard-text="fa fa-paypal">
                            <span class="fa fa-paypal"></span>
                        </li>

                        <li data-clipboard-text="fa fa-area-chart">
                            <span class="fa fa-area-chart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bar-chart">
                            <span class="fa fa-bar-chart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bar-chart-o">
                            <span class="fa fa-bar-chart-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-line-chart">
                            <span class="fa fa-line-chart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pie-chart">
                            <span class="fa fa-pie-chart"></span>
                        </li>

                        <li data-clipboard-text="fa fa-bitcoin">
                            <span class="fa fa-bitcoin"></span>
                        </li>
                        <li data-clipboard-text="fa fa-btc">
                            <span class="fa fa-btc"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cny">
                            <span class="fa fa-cny"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dollar">
                            <span class="fa fa-dollar"></span>
                        </li>
                        <li data-clipboard-text="fa fa-eur">
                            <span class="fa fa-eur"></span>
                        </li>
                        <li data-clipboard-text="fa fa-euro">
                            <span class="fa fa-euro"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gbp">
                            <span class="fa fa-gbp"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gg">
                            <span class="fa fa-gg"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gg-circle">
                            <span class="fa fa-gg-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-ils">
                            <span class="fa fa-ils"></span>
                        </li>
                        <li data-clipboard-text="fa fa-inr">
                            <span class="fa fa-inr"></span>
                        </li>
                        <li data-clipboard-text="fa fa-jpy">
                            <span class="fa fa-jpy"></span>
                        </li>
                        <li data-clipboard-text="fa fa-krw">
                            <span class="fa fa-krw"></span>
                        </li>
                        <li data-clipboard-text="fa fa-money">
                            <span class="fa fa-money"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rmb">
                            <span class="fa fa-rmb"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rouble">
                            <span class="fa fa-rouble"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rub">
                            <span class="fa fa-rub"></span>
                        </li>
                        <li data-clipboard-text="fa fa-ruble">
                            <span class="fa fa-ruble"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rupee">
                            <span class="fa fa-rupee"></span>
                        </li>
                        <li data-clipboard-text="fa fa-shekel">
                            <span class="fa fa-shekel"></span>
                        </li>
                        <li data-clipboard-text="fa fa-sheqel">
                            <span class="fa fa-sheqel"></span>
                        </li>
                        <li data-clipboard-text="fa fa-try">
                            <span class="fa fa-try"></span>
                        </li>
                        <li data-clipboard-text="fa fa-turkish-lira">
                            <span class="fa fa-turkish-lira"></span>
                        </li>
                        <li data-clipboard-text="fa fa-usd">
                            <span class="fa fa-usd"></span>
                        </li>
                        <li data-clipboard-text="fa fa-won">
                            <span class="fa fa-won"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yen">
                            <span class="fa fa-yen"></span>
                        </li>

                        <li data-clipboard-text="fa fa-align-center">
                            <span class="fa fa-align-center"></span>
                        </li>
                        <li data-clipboard-text="fa fa-align-justify">
                            <span class="fa fa-align-justify"></span>
                        </li>
                        <li data-clipboard-text="fa fa-align-left">
                            <span class="fa fa-align-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-align-right">
                            <span class="fa fa-align-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bold">
                            <span class="fa fa-bold"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chain">
                            <span class="fa fa-chain"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chain-broken">
                            <span class="fa fa-chain-broken"></span>
                        </li>
                        <li data-clipboard-text="fa fa-clipboard">
                            <span class="fa fa-clipboard"></span>
                        </li>
                        <li data-clipboard-text="fa fa-columns">
                            <span class="fa fa-columns"></span>
                        </li>
                        <li data-clipboard-text="fa fa-copy">
                            <span class="fa fa-copy"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cut">
                            <span class="fa fa-cut"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dedent">
                            <span class="fa fa-dedent"></span>
                        </li>
                        <li data-clipboard-text="fa fa-eraser">
                            <span class="fa fa-eraser"></span>
                        </li>
                        <li data-clipboard-text="fa fa-file">
                            <span class="fa fa-file"></span>
                        </li>
                        <li data-clipboard-text="fa fa-file-o">
                            <span class="fa fa-file-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-file-text">
                            <span class="fa fa-file-text"></span>
                        </li>
                        <li data-clipboard-text="fa fa-file-text-o">
                            <span class="fa fa-file-text-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-files-o">
                            <span class="fa fa-files-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-floppy-o">
                            <span class="fa fa-floppy-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-font">
                            <span class="fa fa-font"></span>
                        </li>
                        <li data-clipboard-text="fa fa-header">
                            <span class="fa fa-header"></span>
                        </li>
                        <li data-clipboard-text="fa fa-indent">
                            <span class="fa fa-indent"></span>
                        </li>
                        <li data-clipboard-text="fa fa-italic">
                            <span class="fa fa-italic"></span>
                        </li>
                        <li data-clipboard-text="fa fa-link">
                            <span class="fa fa-link"></span>
                        </li>
                        <li data-clipboard-text="fa fa-list">
                            <span class="fa fa-list"></span>
                        </li>
                        <li data-clipboard-text="fa fa-list-alt">
                            <span class="fa fa-list-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-list-ol">
                            <span class="fa fa-list-ol"></span>
                        </li>
                        <li data-clipboard-text="fa fa-list-ul">
                            <span class="fa fa-list-ul"></span>
                        </li>
                        <li data-clipboard-text="fa fa-outdent">
                            <span class="fa fa-outdent"></span>
                        </li>
                        <li data-clipboard-text="fa fa-paperclip">
                            <span class="fa fa-paperclip"></span>
                        </li>
                        <li data-clipboard-text="fa fa-paragraph">
                            <span class="fa fa-paragraph"></span>
                        </li>
                        <li data-clipboard-text="fa fa-paste">
                            <span class="fa fa-paste"></span>
                        </li>
                        <li data-clipboard-text="fa fa-repeat">
                            <span class="fa fa-repeat"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rotate-left">
                            <span class="fa fa-rotate-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rotate-right">
                            <span class="fa fa-rotate-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-save">
                            <span class="fa fa-save"></span>
                        </li>
                        <li data-clipboard-text="fa fa-scissors">
                            <span class="fa fa-scissors"></span>
                        </li>
                        <li data-clipboard-text="fa fa-strikethrough">
                            <span class="fa fa-strikethrough"></span>
                        </li>
                        <li data-clipboard-text="fa fa-subscript">
                            <span class="fa fa-subscript"></span>
                        </li>
                        <li data-clipboard-text="fa fa-superscript">
                            <span class="fa fa-superscript"></span>
                        </li>
                        <li data-clipboard-text="fa fa-table">
                            <span class="fa fa-table"></span>
                        </li>
                        <li data-clipboard-text="fa fa-text-height">
                            <span class="fa fa-text-height"></span>
                        </li>
                        <li data-clipboard-text="fa fa-text-width">
                            <span class="fa fa-text-width"></span>
                        </li>
                        <li data-clipboard-text="fa fa-th">
                            <span class="fa fa-th"></span>
                        </li>
                        <li data-clipboard-text="fa fa-th-large">
                            <span class="fa fa-th-large"></span>
                        </li>
                        <li data-clipboard-text="fa fa-th-list">
                            <span class="fa fa-th-list"></span>
                        </li>
                        <li data-clipboard-text="fa fa-underline">
                            <span class="fa fa-underline"></span>
                        </li>
                        <li data-clipboard-text="fa fa-undo">
                            <span class="fa fa-undo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-unlink">
                            <span class="fa fa-unlink"></span>
                        </li>

                        <li data-clipboard-text="fa fa-angle-double-down">
                            <span class="fa fa-angle-double-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-double-left">
                            <span class="fa fa-angle-double-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-double-right">
                            <span class="fa fa-angle-double-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-double-up">
                            <span class="fa fa-angle-double-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-down">
                            <span class="fa fa-angle-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-left">
                            <span class="fa fa-angle-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-right">
                            <span class="fa fa-angle-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angle-up">
                            <span class="fa fa-angle-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-down">
                            <span class="fa fa-arrow-circle-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-left">
                            <span class="fa fa-arrow-circle-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-o-down">
                            <span class="fa fa-arrow-circle-o-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-o-left">
                            <span class="fa fa-arrow-circle-o-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-o-right">
                            <span class="fa fa-arrow-circle-o-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-o-up">
                            <span class="fa fa-arrow-circle-o-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-right">
                            <span class="fa fa-arrow-circle-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-circle-up">
                            <span class="fa fa-arrow-circle-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-down">
                            <span class="fa fa-arrow-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-left">
                            <span class="fa fa-arrow-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-right">
                            <span class="fa fa-arrow-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrow-up">
                            <span class="fa fa-arrow-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrows">
                            <span class="fa fa-arrows"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrows-alt">
                            <span class="fa fa-arrows-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrows-h">
                            <span class="fa fa-arrows-h"></span>
                        </li>
                        <li data-clipboard-text="fa fa-arrows-v">
                            <span class="fa fa-arrows-v"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-down">
                            <span class="fa fa-caret-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-left">
                            <span class="fa fa-caret-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-right">
                            <span class="fa fa-caret-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-square-o-down">
                            <span class="fa fa-caret-square-o-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-square-o-left">
                            <span class="fa fa-caret-square-o-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-square-o-right">
                            <span class="fa fa-caret-square-o-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-square-o-up">
                            <span class="fa fa-caret-square-o-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-caret-up">
                            <span class="fa fa-caret-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-circle-down">
                            <span class="fa fa-chevron-circle-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-circle-left">
                            <span class="fa fa-chevron-circle-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-circle-right">
                            <span class="fa fa-chevron-circle-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-circle-up">
                            <span class="fa fa-chevron-circle-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-down">
                            <span class="fa fa-chevron-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-left">
                            <span class="fa fa-chevron-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-right">
                            <span class="fa fa-chevron-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chevron-up">
                            <span class="fa fa-chevron-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-exchange">
                            <span class="fa fa-exchange"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hand-o-down">
                            <span class="fa fa-hand-o-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hand-o-left">
                            <span class="fa fa-hand-o-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hand-o-right">
                            <span class="fa fa-hand-o-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hand-o-up">
                            <span class="fa fa-hand-o-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-long-arrow-down">
                            <span class="fa fa-long-arrow-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-long-arrow-left">
                            <span class="fa fa-long-arrow-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-long-arrow-right">
                            <span class="fa fa-long-arrow-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-long-arrow-up">
                            <span class="fa fa-long-arrow-up"></span>
                        </li>
                        <li data-clipboard-text="fa fa-toggle-down">
                            <span class="fa fa-toggle-down"></span>
                        </li>
                        <li data-clipboard-text="fa fa-toggle-left">
                            <span class="fa fa-toggle-left"></span>
                        </li>
                        <li data-clipboard-text="fa fa-toggle-right">
                            <span class="fa fa-toggle-right"></span>
                        </li>
                        <li data-clipboard-text="fa fa-toggle-up">
                            <span class="fa fa-toggle-up"></span>
                        </li>

                        <li data-clipboard-text="fa fa-arrows-alt">
                            <span class="fa fa-arrows-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-backward">
                            <span class="fa fa-backward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-compress">
                            <span class="fa fa-compress"></span>
                        </li>
                        <li data-clipboard-text="fa fa-eject">
                            <span class="fa fa-eject"></span>
                        </li>
                        <li data-clipboard-text="fa fa-expand">
                            <span class="fa fa-expand"></span>
                        </li>
                        <li data-clipboard-text="fa fa-fast-backward">
                            <span class="fa fa-fast-backward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-fast-forward">
                            <span class="fa fa-fast-forward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-forward">
                            <span class="fa fa-forward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pause">
                            <span class="fa fa-pause"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pause-circle">
                            <span class="fa fa-pause-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pause-circle-o">
                            <span class="fa fa-pause-circle-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-play">
                            <span class="fa fa-play"></span>
                        </li>
                        <li data-clipboard-text="fa fa-play-circle">
                            <span class="fa fa-play-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-play-circle-o">
                            <span class="fa fa-play-circle-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-random">
                            <span class="fa fa-random"></span>
                        </li>
                        <li data-clipboard-text="fa fa-step-backward">
                            <span class="fa fa-step-backward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-step-forward">
                            <span class="fa fa-step-forward"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stop">
                            <span class="fa fa-stop"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stop-circle">
                            <span class="fa fa-stop-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stop-circle-o">
                            <span class="fa fa-stop-circle-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-youtube-play">
                            <span class="fa fa-youtube-play"></span>
                        </li>

                        <li data-clipboard-text="fa fa-500px">
                            <span class="fa fa-500px"></span>
                        </li>
                        <li data-clipboard-text="fa fa-adn">
                            <span class="fa fa-adn"></span>
                        </li>
                        <li data-clipboard-text="fa fa-amazon">
                            <span class="fa fa-amazon"></span>
                        </li>
                        <li data-clipboard-text="fa fa-android">
                            <span class="fa fa-android"></span>
                        </li>
                        <li data-clipboard-text="fa fa-angellist">
                            <span class="fa fa-angellist"></span>
                        </li>
                        <li data-clipboard-text="fa fa-apple">
                            <span class="fa fa-apple"></span>
                        </li>
                        <li data-clipboard-text="fa fa-behance">
                            <span class="fa fa-behance"></span>
                        </li>
                        <li data-clipboard-text="fa fa-behance-square">
                            <span class="fa fa-behance-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bitbucket">
                            <span class="fa fa-bitbucket"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bitbucket-square">
                            <span class="fa fa-bitbucket-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bitcoin">
                            <span class="fa fa-bitcoin"></span>
                        </li>
                        <li data-clipboard-text="fa fa-black-tie">
                            <span class="fa fa-black-tie"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bluetooth">
                            <span class="fa fa-bluetooth"></span>
                        </li>
                        <li data-clipboard-text="fa fa-bluetooth-b">
                            <span class="fa fa-bluetooth-b"></span>
                        </li>
                        <li data-clipboard-text="fa fa-btc">
                            <span class="fa fa-btc"></span>
                        </li>
                        <li data-clipboard-text="fa fa-buysellads">
                            <span class="fa fa-buysellads"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-amex">
                            <span class="fa fa-cc-amex"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-diners-club">
                            <span class="fa fa-cc-diners-club"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-discover">
                            <span class="fa fa-cc-discover"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-jcb">
                            <span class="fa fa-cc-jcb"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-mastercard">
                            <span class="fa fa-cc-mastercard"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-paypal">
                            <span class="fa fa-cc-paypal"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-stripe">
                            <span class="fa fa-cc-stripe"></span>
                        </li>
                        <li data-clipboard-text="fa fa-cc-visa">
                            <span class="fa fa-cc-visa"></span>
                        </li>
                        <li data-clipboard-text="fa fa-chrome">
                            <span class="fa fa-chrome"></span>
                        </li>
                        <li data-clipboard-text="fa fa-codepen">
                            <span class="fa fa-codepen"></span>
                        </li>
                        <li data-clipboard-text="fa fa-codiepie">
                            <span class="fa fa-codiepie"></span>
                        </li>
                        <li data-clipboard-text="fa fa-connectdevelop">
                            <span class="fa fa-connectdevelop"></span>
                        </li>
                        <li data-clipboard-text="fa fa-contao">
                            <span class="fa fa-contao"></span>
                        </li>
                        <li data-clipboard-text="fa fa-css3">
                            <span class="fa fa-css3"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dashcube">
                            <span class="fa fa-dashcube"></span>
                        </li>
                        <li data-clipboard-text="fa fa-delicious">
                            <span class="fa fa-delicious"></span>
                        </li>
                        <li data-clipboard-text="fa fa-deviantart">
                            <span class="fa fa-deviantart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-digg">
                            <span class="fa fa-digg"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dribbble">
                            <span class="fa fa-dribbble"></span>
                        </li>
                        <li data-clipboard-text="fa fa-dropbox">
                            <span class="fa fa-dropbox"></span>
                        </li>
                        <li data-clipboard-text="fa fa-drupal">
                            <span class="fa fa-drupal"></span>
                        </li>
                        <li data-clipboard-text="fa fa-edge">
                            <span class="fa fa-edge"></span>
                        </li>
                        <li data-clipboard-text="fa fa-empire">
                            <span class="fa fa-empire"></span>
                        </li>
                        <li data-clipboard-text="fa fa-envira">
                            <span class="fa fa-envira"></span>
                        </li>
                        <li data-clipboard-text="fa fa-expeditedssl">
                            <span class="fa fa-expeditedssl"></span>
                        </li>
                        <li data-clipboard-text="fa fa-fa">
                            <span class="fa fa-fa"></span>
                        </li>
                        <li data-clipboard-text="fa fa-facebook">
                            <span class="fa fa-facebook"></span>
                        </li>
                        <li data-clipboard-text="fa fa-facebook-f">
                            <span class="fa fa-facebook-f"></span>
                        </li>
                        <li data-clipboard-text="fa fa-facebook-official">
                            <span class="fa fa-facebook-official"></span>
                        </li>
                        <li data-clipboard-text="fa fa-facebook-square">
                            <span class="fa fa-facebook-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-firefox">
                            <span class="fa fa-firefox"></span>
                        </li>
                        <li data-clipboard-text="fa fa-first-order">
                            <span class="fa fa-first-order"></span>
                        </li>
                        <li data-clipboard-text="fa fa-flickr">
                            <span class="fa fa-flickr"></span>
                        </li>
                        <li data-clipboard-text="fa fa-font-awesome">
                            <span class="fa fa-font-awesome"></span>
                        </li>
                        <li data-clipboard-text="fa fa-fonticons">
                            <span class="fa fa-fonticons"></span>
                        </li>
                        <li data-clipboard-text="fa fa-fort-awesome">
                            <span class="fa fa-fort-awesome"></span>
                        </li>
                        <li data-clipboard-text="fa fa-forumbee">
                            <span class="fa fa-forumbee"></span>
                        </li>
                        <li data-clipboard-text="fa fa-foursquare">
                            <span class="fa fa-foursquare"></span>
                        </li>
                        <li data-clipboard-text="fa fa-ge">
                            <span class="fa fa-ge"></span>
                        </li>
                        <li data-clipboard-text="fa fa-get-pocket">
                            <span class="fa fa-get-pocket"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gg">
                            <span class="fa fa-gg"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gg-circle">
                            <span class="fa fa-gg-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-git">
                            <span class="fa fa-git"></span>
                        </li>
                        <li data-clipboard-text="fa fa-git-square">
                            <span class="fa fa-git-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-github">
                            <span class="fa fa-github"></span>
                        </li>
                        <li data-clipboard-text="fa fa-github-alt">
                            <span class="fa fa-github-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-github-square">
                            <span class="fa fa-github-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gitlab">
                            <span class="fa fa-gitlab"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gittip">
                            <span class="fa fa-gittip"></span>
                        </li>
                        <li data-clipboard-text="fa fa-glide">
                            <span class="fa fa-glide"></span>
                        </li>
                        <li data-clipboard-text="fa fa-glide-g">
                            <span class="fa fa-glide-g"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google">
                            <span class="fa fa-google"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-plus">
                            <span class="fa fa-google-plus"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-plus-circle">
                            <span class="fa fa-google-plus-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-plus-official">
                            <span class="fa fa-google-plus-official"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-plus-square">
                            <span class="fa fa-google-plus-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-google-wallet">
                            <span class="fa fa-google-wallet"></span>
                        </li>
                        <li data-clipboard-text="fa fa-gratipay">
                            <span class="fa fa-gratipay"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hacker-news">
                            <span class="fa fa-hacker-news"></span>
                        </li>
                        <li data-clipboard-text="fa fa-houzz">
                            <span class="fa fa-houzz"></span>
                        </li>
                        <li data-clipboard-text="fa fa-html5">
                            <span class="fa fa-html5"></span>
                        </li>
                        <li data-clipboard-text="fa fa-instagram">
                            <span class="fa fa-instagram"></span>
                        </li>
                        <li data-clipboard-text="fa fa-internet-explorer">
                            <span class="fa fa-internet-explorer"></span>
                        </li>
                        <li data-clipboard-text="fa fa-ioxhost">
                            <span class="fa fa-ioxhost"></span>
                        </li>
                        <li data-clipboard-text="fa fa-joomla">
                            <span class="fa fa-joomla"></span>
                        </li>
                        <li data-clipboard-text="fa fa-jsfiddle">
                            <span class="fa fa-jsfiddle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-lastfm">
                            <span class="fa fa-lastfm"></span>
                        </li>
                        <li data-clipboard-text="fa fa-lastfm-square">
                            <span class="fa fa-lastfm-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-leanpub">
                            <span class="fa fa-leanpub"></span>
                        </li>
                        <li data-clipboard-text="fa fa-linkedin">
                            <span class="fa fa-linkedin"></span>
                        </li>
                        <li data-clipboard-text="fa fa-linkedin-square">
                            <span class="fa fa-linkedin-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-linux">
                            <span class="fa fa-linux"></span>
                        </li>
                        <li data-clipboard-text="fa fa-maxcdn">
                            <span class="fa fa-maxcdn"></span>
                        </li>
                        <li data-clipboard-text="fa fa-meanpath">
                            <span class="fa fa-meanpath"></span>
                        </li>
                        <li data-clipboard-text="fa fa-medium">
                            <span class="fa fa-medium"></span>
                        </li>
                        <li data-clipboard-text="fa fa-mixcloud">
                            <span class="fa fa-mixcloud"></span>
                        </li>
                        <li data-clipboard-text="fa fa-modx">
                            <span class="fa fa-modx"></span>
                        </li>
                        <li data-clipboard-text="fa fa-odnoklassniki">
                            <span class="fa fa-odnoklassniki"></span>
                        </li>
                        <li data-clipboard-text="fa fa-odnoklassniki-square">
                            <span class="fa fa-odnoklassniki-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-opencart">
                            <span class="fa fa-opencart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-openid">
                            <span class="fa fa-openid"></span>
                        </li>
                        <li data-clipboard-text="fa fa-opera">
                            <span class="fa fa-opera"></span>
                        </li>
                        <li data-clipboard-text="fa fa-optin-monster">
                            <span class="fa fa-optin-monster"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pagelines">
                            <span class="fa fa-pagelines"></span>
                        </li>
                        <li data-clipboard-text="fa fa-paypal">
                            <span class="fa fa-paypal"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pied-piper">
                            <span class="fa fa-pied-piper"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pied-piper-alt">
                            <span class="fa fa-pied-piper-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pied-piper-pp">
                            <span class="fa fa-pied-piper-pp"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pinterest">
                            <span class="fa fa-pinterest"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pinterest-p">
                            <span class="fa fa-pinterest-p"></span>
                        </li>
                        <li data-clipboard-text="fa fa-pinterest-square">
                            <span class="fa fa-pinterest-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-product-hunt">
                            <span class="fa fa-product-hunt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-qq">
                            <span class="fa fa-qq"></span>
                        </li>
                        <li data-clipboard-text="fa fa-ra">
                            <span class="fa fa-ra"></span>
                        </li>
                        <li data-clipboard-text="fa fa-rebel">
                            <span class="fa fa-rebel"></span>
                        </li>
                        <li data-clipboard-text="fa fa-reddit">
                            <span class="fa fa-reddit"></span>
                        </li>
                        <li data-clipboard-text="fa fa-reddit-alien">
                            <span class="fa fa-reddit-alien"></span>
                        </li>
                        <li data-clipboard-text="fa fa-reddit-square">
                            <span class="fa fa-reddit-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-renren">
                            <span class="fa fa-renren"></span>
                        </li>
                        <li data-clipboard-text="fa fa-resistance">
                            <span class="fa fa-resistance"></span>
                        </li>
                        <li data-clipboard-text="fa fa-safari">
                            <span class="fa fa-safari"></span>
                        </li>
                        <li data-clipboard-text="fa fa-scribd">
                            <span class="fa fa-scribd"></span>
                        </li>
                        <li data-clipboard-text="fa fa-sellsy">
                            <span class="fa fa-sellsy"></span>
                        </li>
                        <li data-clipboard-text="fa fa-share-alt">
                            <span class="fa fa-share-alt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-share-alt-square">
                            <span class="fa fa-share-alt-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-shirtsinbulk">
                            <span class="fa fa-shirtsinbulk"></span>
                        </li>
                        <li data-clipboard-text="fa fa-simplybuilt">
                            <span class="fa fa-simplybuilt"></span>
                        </li>
                        <li data-clipboard-text="fa fa-skyatlas">
                            <span class="fa fa-skyatlas"></span>
                        </li>
                        <li data-clipboard-text="fa fa-skype">
                            <span class="fa fa-skype"></span>
                        </li>
                        <li data-clipboard-text="fa fa-slack">
                            <span class="fa fa-slack"></span>
                        </li>
                        <li data-clipboard-text="fa fa-slideshare">
                            <span class="fa fa-slideshare"></span>
                        </li>
                        <li data-clipboard-text="fa fa-snapchat">
                            <span class="fa fa-snapchat"></span>
                        </li>
                        <li data-clipboard-text="fa fa-snapchat-ghost">
                            <span class="fa fa-snapchat-ghost"></span>
                        </li>
                        <li data-clipboard-text="fa fa-snapchat-square">
                            <span class="fa fa-snapchat-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-soundcloud">
                            <span class="fa fa-soundcloud"></span>
                        </li>
                        <li data-clipboard-text="fa fa-spotify">
                            <span class="fa fa-spotify"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stack-exchange">
                            <span class="fa fa-stack-exchange"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stack-overflow">
                            <span class="fa fa-stack-overflow"></span>
                        </li>
                        <li data-clipboard-text="fa fa-steam">
                            <span class="fa fa-steam"></span>
                        </li>
                        <li data-clipboard-text="fa fa-steam-square">
                            <span class="fa fa-steam-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stumbleupon">
                            <span class="fa fa-stumbleupon"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stumbleupon-circle">
                            <span class="fa fa-stumbleupon-circle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-tencent-weibo">
                            <span class="fa fa-tencent-weibo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-themeisle">
                            <span class="fa fa-themeisle"></span>
                        </li>
                        <li data-clipboard-text="fa fa-trello">
                            <span class="fa fa-trello"></span>
                        </li>
                        <li data-clipboard-text="fa fa-tripadvisor">
                            <span class="fa fa-tripadvisor"></span>
                        </li>
                        <li data-clipboard-text="fa fa-tumblr">
                            <span class="fa fa-tumblr"></span>
                        </li>
                        <li data-clipboard-text="fa fa-tumblr-square">
                            <span class="fa fa-tumblr-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-twitch">
                            <span class="fa fa-twitch"></span>
                        </li>
                        <li data-clipboard-text="fa fa-twitter">
                            <span class="fa fa-twitter"></span>
                        </li>
                        <li data-clipboard-text="fa fa-twitter-square">
                            <span class="fa fa-twitter-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-usb">
                            <span class="fa fa-usb"></span>
                        </li>
                        <li data-clipboard-text="fa fa-viacoin">
                            <span class="fa fa-viacoin"></span>
                        </li>
                        <li data-clipboard-text="fa fa-viadeo">
                            <span class="fa fa-viadeo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-viadeo-square">
                            <span class="fa fa-viadeo-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-vimeo">
                            <span class="fa fa-vimeo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-vimeo-square">
                            <span class="fa fa-vimeo-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-vine">
                            <span class="fa fa-vine"></span>
                        </li>
                        <li data-clipboard-text="fa fa-vk">
                            <span class="fa fa-vk"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wechat">
                            <span class="fa fa-wechat"></span>
                        </li>
                        <li data-clipboard-text="fa fa-weibo">
                            <span class="fa fa-weibo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-weixin">
                            <span class="fa fa-weixin"></span>
                        </li>
                        <li data-clipboard-text="fa fa-whatsapp">
                            <span class="fa fa-whatsapp"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wikipedia-w">
                            <span class="fa fa-wikipedia-w"></span>
                        </li>
                        <li data-clipboard-text="fa fa-windows">
                            <span class="fa fa-windows"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wordpress">
                            <span class="fa fa-wordpress"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wpbeginner">
                            <span class="fa fa-wpbeginner"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wpforms">
                            <span class="fa fa-wpforms"></span>
                        </li>
                        <li data-clipboard-text="fa fa-xing">
                            <span class="fa fa-xing"></span>
                        </li>
                        <li data-clipboard-text="fa fa-xing-square">
                            <span class="fa fa-xing-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-y-combinator">
                            <span class="fa fa-y-combinator"></span>
                        </li>
                        <li data-clipboard-text="fa fa-y-combinator-square">
                            <span class="fa fa-y-combinator-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yahoo">
                            <span class="fa fa-yahoo"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yc">
                            <span class="fa fa-yc"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yc-square">
                            <span class="fa fa-yc-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yelp">
                            <span class="fa fa-yelp"></span>
                        </li>
                        <li data-clipboard-text="fa fa-yoast">
                            <span class="fa fa-yoast"></span>
                        </li>
                        <li data-clipboard-text="fa fa-youtube">
                            <span class="fa fa-youtube"></span>
                        </li>
                        <li data-clipboard-text="fa fa-youtube-play">
                            <span class="fa fa-youtube-play"></span>
                        </li>
                        <li data-clipboard-text="fa fa-youtube-square">
                            <span class="fa fa-youtube-square"></span>
                        </li>

                        <li data-clipboard-text="fa fa-ambulance">
                            <span class="fa fa-ambulance"></span>
                        </li>
                        <li data-clipboard-text="fa fa-h-square">
                            <span class="fa fa-h-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-heart">
                            <span class="fa fa-heart"></span>
                        </li>
                        <li data-clipboard-text="fa fa-heart-o">
                            <span class="fa fa-heart-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-heartbeat">
                            <span class="fa fa-heartbeat"></span>
                        </li>
                        <li data-clipboard-text="fa fa-hospital-o">
                            <span class="fa fa-hospital-o"></span>
                        </li>
                        <li data-clipboard-text="fa fa-medkit">
                            <span class="fa fa-medkit"></span>
                        </li>
                        <li data-clipboard-text="fa fa-plus-square">
                            <span class="fa fa-plus-square"></span>
                        </li>
                        <li data-clipboard-text="fa fa-stethoscope">
                            <span class="fa fa-stethoscope"></span>
                        </li>
                        <li data-clipboard-text="fa fa-user-md">
                            <span class="fa fa-user-md"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wheelchair">
                            <span class="fa fa-wheelchair"></span>
                        </li>
                        <li data-clipboard-text="fa fa-wheelchair-alt">
                            <span class="fa fa-wheelchair-alt"></span>
                        </li>
                </ul>
            </div>

        </div>
    </div>
</div>

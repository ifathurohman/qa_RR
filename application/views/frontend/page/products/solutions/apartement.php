<!-- Masthead -->
    <header class="banner banner-full text-white bg-cover" style="background: url('../aset/img/bg-apartement.jpg') top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
        </div>
      </div>
    </header>
   
    <section class="bg-light">
     <div class="container-fluid p-0 aos-init aos-animate" data-aos="fade-down">
        <div class="row list-box-product no-gutters">
        <?php foreach($array_product1 as $a): ?>
         <div class="col-lg-3  aos-animate" data-aos="fade-right">
            <div class="box-product-1">
                <div class="column image">
                    <img src="<?= $a['img']; ?>">
                </div>
                <div class="column text">
		            <p class="title-line-1 mt-30"></p>
                    <p><?= $a['title']; ?></p>
                </div>
            </div>
         </div>
         <?php endforeach; ?>   
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-800p" style="background-image: url('../aset/img/bg-smart-door-lock-polos.jpg');background-size: cover;background-position: center;" >
          <div class="content">
            <h2>TRUE SMART LIFE WITH<br>ORVIBO T1</h2>
            <div class="text clear">
              <div class="item item1">
                <p class="txt1">GUI</p>
                <p class="txt2">Better interaction</p>
              </div>
              <div class="item">
                <p class="txt1">Temporary Code</p>
                <p class="txt2">For unexpected guests</p>
              </div>
              <div class="item">
                <p class="txt1">Accurate Identification</p>
                <p class="txt2">Enable individual settings</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="our-solutions bg-icon-1 text-center" style="min-height: 0px;">
      <div class="container mb-4r">
        <div class="section-title" data-aos="fade-down">MAIN PRODUCT-SMART DOORLOCK T1</div>
        <div class="text-center">
          <div class="border-bottom-blue"></div>
        </div>
      </div>
      <div class="container container-text-center">
        <p>ORVIBO T1, which is a type of stylish and secure zigBee smart lock for 
high-end apartment, achieve the smart access control and security 
management for the apartment. Provide lessee the convenient entry 
experience, and help to improve apartment operation efficiency and safety, 
decrease the cost and expand the brand effect.</p>
        <p>
          <img src="<?= base_url("aset/img/solutions/icon-1.jpg"); ?>" style="width: 250px;">
        </p>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-smart-door-lock-function.jpg'); ?>" class="width-100 wb-height-900p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(51, 1, 30, 0.95), rgba(51, 1, 30, 0.90)), url(../aset/img/bg-smart-door-lock-polos.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white text-center">
            <p class="title mt-80 f-size-28 ">SMART DOORLOCK T1 - FUNCTIONS</p>
            <p class="title-line-center"></p>
            <p class="f-size-16">
              <b>Password Management</b> : Remote manage the passwords.
              Automatic generation and expiration according to the lease term. <br/>
              <b>Doorlock Record Checking</b> : Check the door lock record in real 
              time to avoid disputes.<br/>
              <b>Scramble Password</b> : Input 6 letters ahead or behind the right
              password to unlock and avoid let out the password.<br/>
              <b>Temporary Authorization</b> : Authorize people the temporary 
              password via the APP.<br/>
              <b>Low Battery Warning</b> : Remind on the platform and manage
              efficiently.<br/>
              <b>OTA Update Technology</b> : Remote encryption to obtain 
              more functions.
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-smart-door-lock-polos2.jpg'); ?>" class="width-100 wb-height-500p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-600p" style="background-image: linear-gradient(rgba(51, 1, 30, 0.95), rgba(51, 1, 30, 0.90)), url(../aset/img/bg-smart-door-lock-polos2.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white text-center">
            <p class="title mt-80 f-size-28 ">SMART DOORLOCK T1 - FEATURES </p>
            <p class="title-line-center"></p>
            <p class="f-size-16">
              <b>Designed by the team with iF Gold Award</b><br/>
              Albandon complexity and adopt extremely simple lines
            </p>
            <p class="f-size-16">
              <b>Solid Toughened Glass Panel</b><br/>
              Efficiently prevents scratches and looks exquisite and smooth
            </p>
            <p class="f-size-16">
              <b>Home Security Protection</b>
              128AES encryption technology and German C-grade cylinder
            </p>
            <p class="f-size-16">
              <b>500-Day Long Battery Duration</b><br/>
              Ultra low power consumption design
            </p>
            <p class="f-size-16">
              <b>Stylish Ergonomic Handle</b><br/>
              Passed over 300 thousand times of opening and closing test
            </p>
            <p class="f-size-16">
              <b>Compatible with Standard Door Thickness</b><br/>
              Match with 95% wooden door and security door in the market
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-kursi.jpg'); ?>" class="width-100 wb-height-500p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="our-solutions bg-icon-1 text-center" style="min-height: 0px;">
      <div class="container mb-4r">
        <div class="section-title" data-aos="fade-down">LIGHTING CONTROL</div>
        <div class="text-center">
          <div class="border-bottom-blue"></div>
        </div>
      </div>
      <div class="container container-text-center">
        <p>In-wall lighting control units can be operated centrally and individually.
The illuminance can be reduced by switching off or dimming at desired
time to create perfect scenes to match your mood, as well as to save 
energy and reduce operation cost.</p>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-kursi-2.jpg'); ?>" class="width-100 wb-height-500p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(52, 39, 31, 0.98), rgba(52, 39, 31, 0.96)), url(../aset/img/bg-kursi-2.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">REMOTE CONTROL LIGHTING</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">Starting a magic lighting moment. A key control to turn on/off the light by
"HomeMate" APP and reduce a lot of trouble. No matter where you are
in the worl, your light, music, movie all run smoothly. Your lighting can 
protect your house when you are away. And as you arrive home, 
everything is running just as you like</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-1.png"); ?>" style="height: 60px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-kasur.jpg'); ?>" class="width-100 wb-height-500p cover center">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(52, 39, 31, 0.99), rgba(52, 39, 31, 0.98)), url(../aset/img/bg-kasur.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">LIGHTING SCENE</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">Lighting is an important feature in any home and perfect for building a
new home. Such as the light dimmed slowly at your dining room and 
others shut off to romanticize your dinner time. Flashing all of the light
help enjoy your party time. All of these sence customised by you and 
only needs onekey.</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-2.png"); ?>" style="height: 80px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-security.jpg'); ?>" class="width-100 wb-height-500p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="our-solutions bg-icon-1 text-center" style="min-height: 0px;">
      <div class="container mb-4r">
        <div class="section-title" data-aos="fade-down">SECURITY SYSTEM</div>
        <div class="text-center">
          <div class="border-bottom-blue"></div>
        </div>
      </div>
      <div class="container container-text-center">
        <p>Using Orvibo Zigbee motion and window & door sensors with wireless
camera to monitor your home and display all the information on your
smartphone. Get notification no matter where you're around the globe.
Our secure Zigbee security system provides you a true peace of mind.</p>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-home-arming.jpg'); ?>" class="width-100 wb-height-500p cover bottom">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(80, 59, 76, 0.99), rgba(80, 59, 76, 0.98)), url(../aset/img/bg-home-arming.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">HOME ARMING</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">No matter where you are in the house, grant access to the house and
receive notification that something happen wrong, such as the garage 
door is opened and the gas is leaked. Monitor the state of your home,
enjoy the time at home. Providing additional security and added peace 
of mind</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-3.png"); ?>" style="height: 80px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-away-arming.jpg'); ?>" class="width-100 wb-height-500p cover bottom">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(43, 31, 41, 0.99), rgba(43, 31, 41, 0.98)), url(../aset/img/bg-away-arming.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">AWAY ARMING</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">Create your own Smart Home security network with this easy install
motion sesor. No electrician required; this is a typical do-it-yourself
installation and affordable for conversion certain windows and doors or
focus on certain rooms or the entire home. Get alerted anywhere in the 
word if someone or something is moving about in your home</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-4.png"); ?>" style="height: 80px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-adv-building.jpg'); ?>" class="width-100 wb-height-500p cover top">
          </div>
        </div>
      </div>
    </section>
    <section class="our-solutions bg-icon-1 text-center" style="min-height: 0px;">
      <div class="container mb-4r">
        <div class="section-title" data-aos="fade-down">ADVANCE BUILDING AUTOMATION</div>
        <div class="text-center">
          <div class="border-bottom-blue"></div>
        </div>
      </div>
      <div class="container container-text-center">
        <p>The most optimal and dreamy lifestyle to people is control everything of
your house by the phone. ORVIBO has several technology for you to
achieve. The smart control remote turns every home appliance into
brand-new smart appliance. All your home electrical and mechanical
appliances can be turned on/off, raised/lowered in volume, and even
temperature at the desired level and time with a touch of your finger.</p>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-dapur.jpg'); ?>" class="width-100 wb-height-500p cover bottom">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(6, 58, 116, 0.98), rgba(6, 58, 116, 0.96)), url(../aset/img/bg-dapur.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">DOMESTIC APPLIANCE CONTROL</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">Integrate the ORVIBO with your existing appliances so that can be 
activated on a schedule or with just a few taps on your phone. Users
can confirm the status of the refrigerator and set timing open kettle by
WiFi socket or turn on/off TV, air-conditioning by infrared remote control.
Electricity usage at a glance.</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-5.png"); ?>" style="height: 80px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-white">
          <div class="col-lg-12">
            <img src="<?= site_url('aset/img/bg-hordeng-auto.jpg'); ?>" class="width-100 wb-height-500p cover bottom">
          </div>
        </div>
      </div>
    </section>
    <section class="buy-report showcase">
      <div class="container-fluid p-0" data-aos="fade-down">
        <div class="row no-gutters bg-img-1 wb-height-500p" style="background-image: linear-gradient(rgba(0, 30, 64, 0.98), rgba(0, 30, 64, 0.96)), url(../aset/img/bg-hordeng-auto.jpg);background-size: cover;background-position: center;" >
         <div class="container div-container text-white ">
            <p class="title mt-80 f-size-28 ">MECHANICAL EQUIPMENT CONTROL</p>
            <p class="title-line-center"></p>
            <p class="f-size-16 container-text-center">ZigBee multi-functional relay is designed to control to motors railway
curtain, electric window, garage door and garden irrigation devices. With
the multi-functional relay, users can open or close curtains, electric
window, garage door and garden irrigation devices by HomeMate App
on the smartphone.</p>
            <p class="mt-20">
              <img src="<?= base_url("aset/img/icons/icon-6.png"); ?>" style="height: 80px;" class="and-width-300p">
            </p>
          </div>
        </div>
      </div>
    </section>
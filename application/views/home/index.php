    <!-- SLIDER -->
    <section>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item slider1 active">
                    <img src="home_assets/images/slider/main1.jpg" alt="">
                    <div class="carousel-caption slider-con">
                        <!-- <h2>Welcome to <span>Bcet</span></span></h2>
                        <p><i>where aspiration becomes reality</i>       -->                 </p>
                    </div>
                </div>
                <div class="item">
                     <img src="home_assets/images/slider/main2.jpg" alt=""> 
                    <div class="carousel-caption slider-con">
                         <h2>CAMPUS <span>view</span></span></h2>
                        <p><i>No one should be denied the opportunity to get an education and increase their earning potential based solely on their inability to pay for a college education.</i>
                        </p>
                    </div>
                </div>
                <div class="item">
                     <img src="home_assets/images/slider/main3.jpg" alt=""> 
                    <div class="carousel-caption slider-con">
                        <h2>Management <span>Offices</span></span></h2>
                        <p><i>Do not be afraid to ask for help. Management is always with you!</i>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fa fa-chevron-left slider-arr"></i>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fa fa-chevron-right slider-arr"></i>
            </a>
        </div>
    </section>

    <!-- About College -->
    <section>
        <div class="container com-sp pad-bot-70">
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="con-title">
                    <h2>About<span> College</span></h2>
                </div>
              </div>
             <div class="row">
            <div class="col-md-6">
              <div class="about-text">
                <h4>Our Vision</h4>
                <p class="text-justify">The college has been established with a moto to provide the best technical education and skill of international quality to the students, to provide global perspective in attitude 
                and to build up leadership qualities within the students of BCET.
               </p>
                <p class="text-justify">To bring about total personality development and create conscious and responsible world citizens. To inspire and support creative abilities, research and entrepreneurship temperament. To establish and promote close interaction with industry and other utility sectors and keep abreast with state </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="about-text">
                <h4>Our Mission</h4>
                <p class="text-justify">To offer industry specific certified educational programs that will blend the creativity, analytical skills and process oriented learning in the delivery mechanism with high degree of industrial interaction.</p>
              </div>
            </div>
            </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="con-title">
                    <h2><i class="fa fa-envelope"></i><span> News & Event</span></h2>
                </div>
              </div>
              <div class="col-md-12">
              <div class="about-text">
                <div style="height:250px;overflow-y: scroll;">
                <ul class="list-group">
                  <?php if(!empty($notices)):foreach($notices as $value): ?>
                  <li class="list-group-item"><i class="fa fa-arrow-circle-right" style="color:#2b96cc;"></i> <a href="<?=base_url('notice_files/'.$value->file_name)?>" target="_blank" title=""><?=$value->notice_subject?></a></li>
                  <?php endforeach;endif; ?>
                </ul>
              </div>
              </div>
            </div>
            </div>
          </div>
        </div>
    </section>
    <div id="testimonials" class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="row testimonials">
          <div class="col-sm-4">
            <blockquote><i class="fa fa-quote-left"></i>
              <p align="center">BCET is still blooming to be multi colored blossom</p>
              <div class="clients-name">
                <p><strong>Dr M.K. BISWAL</strong><br>
                  <em>CHAIRMAN,BCET</em></p>
              </div>
            </blockquote>
          </div>
          <div class="col-sm-4">
            <blockquote><i class="fa fa-quote-left"></i>
              <p align="center">The College prides itself on a caring approach to students with specialist staff</p>
              <div class="clients-name">
                <p><strong>Dr A.K. PANDA</strong><br>
                  <em>DIRECTOR,BCET</em></p>
              </div>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



    


    <section>
        <div class="container com-sp">
            <div class="row">
                <div class="con-title">
                    <h2>College<span> Activities & Events</span></h2>
                    <p></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="bot-gal h-gal ho-event-mob-bot-sp">
                        <h4>Photo Gallery</h4>
                        <ul>
                            <?php foreach ($gallery as $key => $value):?>
                            <li><img height="100" width="100%" class="materialboxed" data-caption="<?=$value->title?>" src="<?=base_url('home_assets/images/'.$value->pic)?>" alt="">
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="<?=base_url('photos')?>" class="btn btn-primary btn-sm">More Photos</a>
                </div>
                <div class="col-md-4">
                    <div class="bot-gal h-vid ho-event-mob-bot-sp">
                        <h4>Video Gallery</h4>
                        <iframe src="https://www.youtube.com/embed/X-5pMrU0r2M?autoplay=0&amp;showinfo=0&amp;controls=0" allowfullscreen></iframe>
                    </div>
                    <a href="<?=base_url('videos')?>" class="btn btn-primary btn-sm">More Videos</a>
                </div>
                <!-- <div class="col-md-4">
                    <div class="bot-gal h-blog ho-event">
                        <h4>News & Event</h4>
                        <div class="ho-event">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->



   

<?php 
$extra = $this->db->order_by('sort', 'ASC')->get_where('web',['con_type'=>'web'])->result();
$about = $this->db->order_by('sort', 'ASC')->get_where('web',['con_type'=>'about'])->result();
?>

<link href="https://itsolutionstuff.com/newTheme/css/bootstrap.min.css" rel="stylesheet">
<body>
    <!-- MOBILE MENU -->
    
    <section>

        <div class="ed-mob-menu">
            <div class="ed-mob-menu-con">
                <div class="ed-mm-left">
                    <div class="wed-logo">
                         <a href="#"><img src="<?=base_url('home_assets/images/bcetlogo.png')?>" alt=""> 
                        </a>
                    </div>
                </div>
                <div class="ed-mm-right">
                    <div class="ed-mm-menu">
                        <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>
                        <div class="ed-mm-inn">
                            <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>
                            <h4>Menu</h4>
                            
                            <ul>
                                <li><a href="<?=base_url('')?>">Home</a></li>
                                <li><a href="<?=base_url('auth/login')?>" >Academic Login</a>
                                                 
                                <?php foreach ($about as $key => $value): ?>
                                <li><a href="<?=base_url('about/'.$value->id)?>"><?=$value->title ?></a></li>
                                <?php endforeach; ?>
                                <?php foreach ($extra as $key => $value): ?>
                                <li><a href="<?=base_url('extra')?>"><?=$value->title ?></a></li>
                                <?php endforeach; ?>
                                
                               <li><a href="<?=base_url('admission')?>">Admission</a></li>
                                <li><a href="<?=base_url('contact')?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>

     <!-- TOP BAR -->
        <div class="ed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ed-com-t1-left">
                            <ul>
                                <li><a href="#">Contact: NH-5,Sergarh,Balasore,Orissa,Pin:-756060</a>
                                </li>
                                <li><a href="#">Phone: (06782)236045</a>
                                </li>
                            </ul>
                        </div>
                        <div class="ed-com-t1-right">
                            <ul>
                                <li><a href="<?=base_url('auth/login')?>" >Academic Login</a>
                                </li>
                               <li><a href="#" data-toggle="modal" data-target="#modal1">Student Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- LOGO AND MENU SECTION -->
        <div class="top-logo" data-spy="affix" data-offset-top="250">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wed-logo">
                            <a href="#"><img src="<?=base_url('home_assets/images/bcetlogo.png')?>" alt="" />
                            </a>
                        </div>
                        <div class="main-menu">
                            <ul>
                                <li><a href="<?=base_url()?>">Home</a>
                                </li>
                                <li class="about-menu">
                                    <a href="<?=base_url('')?>" class="mm-arr">About us</a>
                                    <!-- MEGA MENU 1 -->
                                    <div class="mm-pos">
                                        <div class="about-mm m-menu">
                                            <div class="m-menu-inn">
                                                <div class="mm1-com mm1-s1">
                                                   <div class="ed-course-in">
                                                        <a class="course-overlay menu-about" href="#">
                                                            <img  width="400" src="<?=base_url('home_assets/images/main1.jpg')?>" alt="">
                                                            <span>Academics</span>
                                                        </a>
                                                    </div>
                                                 </div>
                                                <div class="mm1-com mm1-s2">
                                                    <p class="text-justify">  The college has been established with a moto to provide the best technical education and skill of international quality to the students, to provide global perspective in attitude and to build up leadership qualities within the students of BCET</p>
                                                </div>
                                                <div class="mm1-com mm1-s1">
                                                   <ul>
                                                    <?php foreach ($about as $key => $value): ?>
                                                        <li><a href="<?=base_url('about/'.$value->url)?>">About <?=$value->title ?></a></li>
                                                     <?php endforeach; ?>
                                                     </ul>  
                                                </div>
                                                <div class="mm1-com mm1-s1">
                                                    <ul>
                                                    <?php foreach ($extra as $key => $value): ?>
                                                        <li><a href="<?=base_url('extra/'.$value->url)?>"><?=$value->title ?></a></li>
                                                     <?php endforeach; ?>
                                                     </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                                
                                                    
                                <!-- <li><a class='dropdown-button ed-sub-menu' href='#' data-activates='dropdown1'>Courses</a></li> -->
                                <li class="cour-menu">
                                    <a href="#" class="mm-arr">Department</a>
                                    
                                    <div class="mm-pos">
                                        <div class="cour-mm m-menu">
                                            <div class="m-menu-inn">
                                                <?php foreach($course as $key=>$value): ?>
                                                 <div class="mm1-com  mm1-s1">
                                                    <h5><?=$value?></h5>
                                                    <ul>
                                                        <?php foreach($branches[$key] as $k => $val): ?>
                                                        <li><a title="<?=$val?>" href="<?=base_url('faculty/'.$k)?>"><?=((strlen($val)>29)?substr($val,0,29).'...':$val)?></a></li>
                                                       <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                               <?php endforeach;  ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="admi-menu">
                                    <a href="#" class="mm-arr">Student Activities</a>
                                    <!-- MEGA MENU 1 -->
                                    <div class="mm-pos">
                                        <div class="admi-mm m-menu">
                                            <div class="m-menu-inn">
                                                <div class="mm2-com mm1-com mm1-s1">
                                                    <div class="ed-course-in">
                                                        <a class="course-overlay" href="#">
                                                            <ul>
                                                                <li>
                                                                    <img src="<?=base_url()?>home_assets/images/main1.jpg" alt="" style="height:120px !important;">
                                                                </li> 
                                                            </ul>  
                                                        </a>
                                                    </div>
                                                    <a href="<?=base_url("photos")?>" class="mm-r-m-btn">Gallery</a>
                                                </div>
                                                <div class="mm2-com mm1-com mm1-s1">
                                                    <div class="ed-course-in">
                                                        <a class="course-overlay" href="#">
                                                        <ul>
                                                             <li><img src="<?=base_url()?>home_assets/images/youtube.jpg" alt="" style="height:120px !important;">
                                                             </li> 
                                                        </ul>     
                                                        </a>
                                                    </div>
                                                    <a href="<?=base_url("videos")?>" class="mm-r-m-btn">Videos</a>
                                                </div>
                                                <div class="mm2-com mm1-com mm1-s1">
                                                    <div class="ed-course-in">
                                                        <a class="course-overlay" href="#">
                                                            <ul>
                                                                <li><img src="<?=base_url()?>home_assets/images/Seminar.jpg" alt="" style="height:120px !important;">
                                                                </li> 
                                                            </ul>  
                                                        </a>
                                                    </div>
                                                    <a href="<?=base_url("seminar")?>" class="mm-r-m-btn">Seminar</a>
                                                </div>
                                                <div class="mm2-com mm1-com mm1-s1">
                                                    <!-- <div class="ed-course-in">
                                                        <a class="course-overlay" href="#">
                                                            <ul>
                                                                <li><img src="<?=base_url()?>home_assets/images/notice.jpg" alt="" style="height:120px !important;">
                                                                </li> 
                                                            </ul>  
                                                        </a>
                                                    </div>
                                                    <a href="<?=base_url("notices")?>" class="mm-r-m-btn">Notice</a>
                                                </div>  -->   
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="<?=base_url('notices')?>">Notices</a>
                                </li>
                                <li><a href="<?=base_url('admission')?>">Admission</a>
                                </li>           
                                <li><a href="<?=base_url('contact')?>">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="all-drop-down-menu">
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!--END HEADER SECTION-->
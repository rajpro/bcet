<?php if (!empty($this->session->profile['pic'])) {
  if ($this->session->user_type!=2) {
    $pic=base_url('staffimages/'.$this->session->profile['pic']);
  }
  else{
    $pic=base_url('teacherimages/'.$this->session->profile['pic']);
  }
}else{
  $pic=base_url('assets/img/avatar.png');
}
$notification = $this->db->order_by('id','DESC')->get_where('notification',['user_type'=>$this->session->user_type,'user_id'=>$this->session->profile['id']])->result();
?>
<body>
  <div class="ajax-loader">
    <p class="text-center" style="font-size: 8em;margin-top:20%;">Loading</p>
  </div>
<div class="be-wrapper be-fixed-sidebar">
  <nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
      <div class="navbar-header"><a href="<?=base_url()?>" class="navbar-brand" style="font-size:3em;"><img src="<?=base_url('home_assets/images/bcetlogo.png')?>" style="margin-top:10px;width:200px;"/></a></div>
      <div class="pull-left visible-md visible-lg" style="margin-top: 15px;margin-left:30px;font-size: 18px;">Welcome <?=ucwords($this->session->profile['name'])?></div>
      <div class="be-right-navbar">
        <ul class="nav navbar-nav navbar-right be-user-nav">
          <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?=$pic?>" alt="Avatar"><span class="user-name"><?=ucwords($this->session->profile['name'])?></span></a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <div class="user-info">
                  <div class="user-name"><?=ucwords($this->session->profile['name'])?></div>
                  <div class="user-position online">Available</div>
                </div>
              </li>
              <li><a href="<?=base_url('dashboard/account')?>"><span class="icon mdi mdi-face"></span> Account</a></li>
              <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>
              <li><a href="<?=base_url('auth/logout')?>"><span class="icon mdi mdi-power"></span> Logout</a></li>
            </ul>
          </li>
        </ul>
        <!-- <div class="page-title"><span>Dashboard</span></div> -->
        <ul class="nav navbar-nav navbar-right be-icons-nav">
          <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span></a>
            <ul class="dropdown-menu be-notifications">
              <li>
                <div class="title">Notifications</div>
                <div class="list">
                  <div class="be-scroller">
                    <div class="content">
                      <ul id="notifi-content">
                        <?php if(!empty($notification)):foreach($notification as $value): ?>
                        <li onclick="readnotification()" class="notification <?=($value->status=='open')?'notification-unread':''?>"><a href="#">
                            <div class="image"><img src="<?=base_url()?>assets/img/avatar2.png" alt="Avatar"></div>
                            <div class="notification-info">
                              <div class="text"><?=$value->notice_subject?></div><span class="date"><?=$value->not_date?></span>
                        </div></a></li>
                        <?php endforeach;endif; ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer"> <a href="<?=base_url('notification')?>">View all notifications</a></div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
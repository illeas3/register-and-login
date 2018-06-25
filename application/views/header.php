<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$id=$this->session->userdata('userid');
$user=$this->db->get_where('users' , array('id' => $id))->row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title><?=$title;?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?=base_url();?>assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?=base_url();?>assets/images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->


    <!-- CORE CSS-->    
    <link href="<?=base_url();?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?=base_url();?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- CSS for full screen (Layout-2)-->    
    <link href="<?=base_url();?>assets/css/layouts/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?=base_url();?>assets/css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?=base_url();?>assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?=base_url();?>assets/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?=base_url();?>assets/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <script type="text/javascript">
    function getlanguage(val) {
       $.ajax({  
            url:"<?php echo base_url();?>ajax/getlanguage",  
            method:"POST",  
            data:{val:val},  
            success:function(a)  
            { 
              window.location.replace("<?=base_url();?>home")
            }  
        });
    }
    </script>

</head>

<body>
<?php
if(($this->session->userdata('error')!=" ") && !empty($this->session->userdata('error'))){
?>
<div id="card-alert" class="card red">
  <div class="card-content white-text">
    <p><i class="mdi-alert-error"></i> <?=$this->session->userdata('error');?></p>
  </div>
  <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<?php
  $this->session->unset_userdata('error');
}

if(($this->session->userdata('success')!=" ") && !empty($this->session->userdata('success'))){
?>
<div id="card-alert" class="card green">
  <div class="card-content white-text">
    <p><i class="mdi-navigation-check"></i> <?=$this->session->userdata('success');?></p>
  </div>
  <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<?php
  $this->session->unset_userdata('success');
}
?>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="<?=base_url();?>" class="brand-logo darken-1"><img src="<?=base_url();?>assets/images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize"/>
                    </div>
                    <ul class="right hide-on-med-and-down">
                      <?php 
                      if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){
                            $id=$this->session->userdata('userid');
                        $getlanguage=$this->db->get_where('users' , array('id' => $id))->row()->language;
                        if($getlanguage){
                          $language=$getlanguage;
                        }else{
                          $language=$this->db->get_where('settings')->row()->language;
                        }
                      }elseif(($this->session->userdata('language')!="") && !empty($this->session->userdata('language'))){
                        $language=$this->session->userdata('language');
                      }else{
                        $language=$this->db->get_where('settings')->row()->language;
                      }
                      if ($language=="english") {
                        $img="United-States.png";
                      }elseif ($language=="french") {
                        $img="France.png";
                      }elseif ($language=="chinese") {
                        $img="China.png";
                      }elseif ($language=="german") {
                        $img="Germany.png";
                      } ?>
                        <li><a href="#" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="<?=base_url();?>assets/images/flag-icons/<?=$img;?>" alt="USA" /></a>
                        </li>
                        <!-- <li><a href="<?=base_url();?>assets/javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li> -->
                        <li><a href="<?=base_url();?>assets/javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i>
                        
                        </a>
                        </li>                        
                        <!-- <li><a href="<?=base_url();?>assets/#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li> -->
                    </ul>
                    <!-- translation-button -->
                    <ul id="translation-dropdown" class="dropdown-content">
                      <li>
                        <a onclick="getlanguage('english')" href=""><img src="<?=base_url();?>assets/images/flag-icons/United-States.png" alt="English" />  <span class="language-select">English</span></a>
                      </li>
                      <li>
                        <a onclick="getlanguage('french')" href=""><img src="<?=base_url();?>assets/images/flag-icons/France.png" alt="French" />  <span class="language-select">French</span></a>
                      </li>
                      <li>
                        <a onclick="getlanguage('chinese')" href=""><img src="<?=base_url();?>assets/images/flag-icons/China.png" alt="Chinese" />  <span class="language-select">Chinese</span></a>
                      </li>
                      <li>
                        <a onclick="getlanguage('german')" href=""><img src="<?=base_url();?>assets/images/flag-icons/Germany.png" alt="German" />  <span class="language-select">German</span></a>
                      </li>
                    </ul>
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class="new badge">5</span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="<?=base_url();?>assets/#!"><i class="mdi-action-add-shopping-cart"></i> A new order has been placed!</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                      </li>
                      <li>
                        <a href="<?=base_url();?>assets/#!"><i class="mdi-action-stars"></i> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                      </li>
                      <li>
                        <a href="<?=base_url();?>assets/#!"><i class="mdi-action-settings"></i> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                      </li>
                      <li>
                        <a href="<?=base_url();?>assets/#!"><i class="mdi-editor-insert-invitation"></i> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                      </li>
                      <li>
                        <a href="<?=base_url();?>assets/#!"><i class="mdi-action-trending-up"></i> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                      </li>
                    </ul>
                    <?php if (($this->session->userdata('user')!="") && !empty($this->session->userdata('userid'))){ ?>
                    <ul class="right"> 
                      <a class="btn dropdown-button waves-effect waves-light" href="#!" data-activates="dropdown1"><?=$user->first_name;?><i class="mdi-navigation-arrow-drop-down" style="width: 2px;"></i></a>
                    </ul>
                    <?php } ?>
                    <ul id="dropdown1" class="dropdown-content">
                      <li><a href="<?=base_url();?>home/profile" class="-text">Profile</a>
                      </li>
                      <li><a href="#!" class="-text">Edit</a>
                      </li>
                      <li><a href="<?=base_url();?>login/logout" class="-text">Logout</a>
                      </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->
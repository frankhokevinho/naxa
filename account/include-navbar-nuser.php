<?php
if (is_user()) {
redirect("$baseurl/Dashboard");
}
?>



 <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?php echo $fronturl; ?>">
                            <img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="logo" class="logo-default" style="max-height: 40px;">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                     <div class="hor-menu  ">
                        <ul class="nav navbar-nav">


                        
<li><a href="<?php echo $fronturl; ?>">Home</a></li>

<?php 
$ddaa = $db->query("SELECT id, name FROM menus ORDER BY id");
while ($data = $ddaa->fetch()){
$uri = urlmod($data[1]);
?>
  <li>
      <a href="<?php echo "$fronturl/menu/$data[0]/$uri"; ?>" class="dropdown-toggle">
          <?php echo $data[1];  ?>
      </a>
  </li>

<?php 
}
?>

<li class="" style="padding-left: 40px;"> &nbsp; </li>
<li><a href="<?php echo $baseurl; ?>"> <i class="fa fa-sign-in"> </i> SIGN IN </a></li>     
<li><a href="<?php echo $baseurl; ?>/Register">  <i class="fa fa-edit"> </i>  Sign Up </a></li>    



                            
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->




        
<!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->

                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                       <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">


